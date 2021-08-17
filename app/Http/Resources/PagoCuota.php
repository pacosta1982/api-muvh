<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PagoCuota extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /*$hoy = new \DateTime();
        $vencimiento = new \DateTime($this->ChRecFvt);
        $diasAtraso = ($vencimiento < $hoy) ? $hoy->diff($vencimiento)->format("%a") : '0';
        $TotalPun = $this->ChPunDia * $diasAtraso;
        $TotalMor = $this->ChMorDia * $diasAtraso;
        $montoTotal = $this->ChTotal + $TotalMor + $TotalPun + $this->ChPagCom;*/

        return [
            'nroCuota' => $this->ChRecNcu,
            'ChEstado' => $this->ChEstado,
            /*'ChTotal' => $this->ChTotal,
            'monPun' => $TotalPun,
            'monMor' => $TotalMor,
            'montoTotal' => $montoTotal,
            'diasAtraso' => $diasAtraso,
            'comision' => $this->ChPagCom,
            'PylCod' => trim($this->PylCod),
            'CliNop' => $this->CliNop,
            'CliSec' => $this->CliSec,
            'ChRecSeg' => $this->ChRecSeg,
            'ChCiaSeg' => $this->ChCiaSeg,*/
            /*'comision' => $this->ChPagCom,
            'PylCod' => trim($this->PylCod),
            'CliNop' => $this->CliNop,
            'CliSec' => $this->CliSec,
            'ChRecNcu' => $this->ChRecNcu,
            //'hoy' => date('Y-m-d'),
            'fecha' => $this->ChRecFvt,
            'diasAtraso' => $diasAtraso,
            'ChMorDia' => $this->ChMorDia,
            'TotalMor ' => $this->ChMorDia * $diasAtraso,
            'TotalPun ' => $this->ChPunDia * $diasAtraso,*/
            //'montoTotal' =>
            /*'PerCod' => $this->PerCod,
            'ChRecNcu' => $this->ChRecNcu,
            'ChRecFvt' => $this->ChRecFvt,

            'ChCptId' => $this->ChCptId,
            'ChRecSer' => $this->ChRecSer,
            'ChRecNrc' => $this->ChRecNrc,

            'ChSalAnt' => $this->ChSalAnt,
            'ChRecAmr' => $this->ChRecAmr,
            'ChRecAjt' => $this->ChRecAjt,

            'ChRecInt' => $this->ChRecInt,
            'ChRecSeg' => $this->ChRecSeg,
            'ChRecCom' => $this->ChRecCom,


            'ChTotal' => $this->ChTotal,
            'ChMorDia' => $this->ChMorDia,
            'ChPunDia' => $this->ChPunDia,

            'ChUsuCbr' => $this->ChUsuCbr,
            'ChUsuGen' => trim($this->ChUsuGen),
            'ChFecGen' => $this->ChFecGen,

            'ChPagFec' => $this->ChPagFec,
            'ChPagHora' => $this->ChPagHora,
            'ChPagMor' => $this->ChPagMor,




            'ChPagPun' => $this->ChPagPun,
            'ChPagCom' => $this->ChPagCom,
            'ChPagTot' => $this->ChPagTot,

            'ChPagFop' => $this->ChPagFop,
            'ChPagCod' => $this->ChPagCod,
            'ChCbrCod' => $this->ChCbrCod,

            'ChUsuOpe' => $this->ChUsuOpe,
            'ChFecSis' => $this->ChFecSis,
            'ChEstado' => $this->ChEstado,

            'ChPerNom' => trim($this->ChPerNom),
            'ChCiaSeg' => $this->ChCiaSeg,*/
            //'created_at' => $this->created_at->format('m/d/Y'),
            //'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
