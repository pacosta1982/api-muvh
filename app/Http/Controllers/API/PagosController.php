<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\PRMCHEQ;
use App\Http\Resources\PRMCHEQ as CuotasResource;
use App\Http\Resources\PagoCuota as PagoCuotaResource;
use Carbon\Carbon;

class PagosController extends BaseController
{
    //
    public function index($cedula = null)
    {

        if (!$cedula) {
            return $this->sendError('El campo cedula es requerido');
        }

        try {
            $cuotas = PRMCHEQ::where('PerCod', $cedula)
                ->whereIn('ChEstado', ['', 'RE'])
                ->orderBy('ChRecNcu')
                ->first();
            if ($cuotas === null) {
                return $this->sendError('No se encuentran datos del Cliente');
            }


            $hoy = new \DateTime();
            $vencimiento = new \DateTime($cuotas->ChRecFvt);
            $diasAtraso = ($vencimiento < $hoy) ? $hoy->diff($vencimiento)->format("%a") : '0';
            $TotalPun = $cuotas->ChPunDia * $diasAtraso;
            $TotalMor = $cuotas->ChMorDia * $diasAtraso;
            $montoTotal = $cuotas->ChTotal + $TotalMor + $TotalPun + $cuotas->ChPagCom;

            $data = array(
                'nroCuota' => $cuotas->ChRecNcu,
                'ChTotal' => $cuotas->ChTotal,
                'monPun' => $TotalPun,
                'monMor' => $TotalMor,
                'montoTotal' => $montoTotal,
                //'diasAtraso' => $diasAtraso,
                //'comision' => $cuotas->ChPagCom,
                'PylCod' => trim($cuotas->PylCod),
                'CliNop' => $cuotas->CliNop,
                'CliSec' => $cuotas->CliSec,
                'ChRecSeg' => $cuotas->ChRecSeg,
                'ChCiaSeg' => $cuotas->ChCiaSeg,

            );

            return $this->sendResponse($data/*CuotasResource::collection($cuotas)*/, 'Cuota Pendiente');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->sendError('Error en la Consulta');
        }
    }

    public function pagoCuota(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nroCedula' => 'required',
            //'nroCuota' => 'required',
            'PylCod' => 'required',
            'CliNop' => 'required',
            'CliSec' => 'required',
            'ChRecNcu' => 'required',
            'ChPagCod' => 'required',
            'ChPagCom' => 'required',
            'NumeroRecibo' => 'required',
            'monPun' => 'required',
            'monMor' => 'required',
            'PagoTotal' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }



        $cuotas = PRMCHEQ::where('PerCod', $input['nroCedula'])
            ->where('ChRecNcu', $input['nroCuota'])
            ->where('PylCod', $input['PylCod'])
            ->where('CliNop', $input['CliNop'])
            ->where('CliSec', $input['CliSec'])
            ->update(array(
                'ChEstado' => 'PA',
                'ChPagHora' => date('H:i:s'),
                'ChPagMor' => $input['monMor'],
                'ChPagPun' => $input['monPun'],
                'ChPagCom' => $input['ChPagCom'],
                'ChPagTot' => $input['PagoTotal'],
                'ChPagFec' => date('Y-d-m'),
                'ChPagFop' => date('Y-d-m H:i:s'),
                'ChFecSis' => date('Y-d-m H:i:s'),
                'ChPagCod' => $input['ChPagCod'],
                'ChRecNrc' => $input['NumeroRecibo']
            ));

        $data = array();

        return $this->sendResponse($data, 'Procesado Correctamente');
    }

    public function reversaCuota(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'NumeroRecibo' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $cuotas = PRMCHEQ::where('ChRecNrc', $input['NumeroRecibo'])
            ->where('ChEstado', 'PA')
            ->update(array(
                'ChEstado' => 'RE',
                'ChPagHora' => '',
                'ChPagMor' => 0,
                'ChPagPun' => 0,
                'ChPagCom' => 0,
                'ChPagTot' => 0,
                'ChPagFec' => null,
                'ChPagFop' => null,
                'ChFecSis' => null,
                'ChPagCod' => '',
                'ChRecNrc' => 0
            ));

        $data = array();
        return $this->sendResponse($data, 'Reversado Correctamente');
    }
}
