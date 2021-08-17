<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PRMCHEQ extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $hoy = new \DateTime();
        $vencimiento = new \DateTime($this->ChRecFvt);
        $diasAtraso = ($vencimiento < $hoy) ? $hoy->diff($vencimiento)->format("%a") : '0';
        $TotalPun = $this->ChPunDia * $diasAtraso;
        $TotalMor = $this->ChMorDia * $diasAtraso;
        $montoTotal = $this->ChTotal + $TotalMor + $TotalPun + $this->ChPagCom;

        return [
            'nroCuota' => $this->ChRecNcu,
            'ChTotal' => $this->ChTotal,
            'monPun' => $TotalPun,
            'monMor' => $TotalMor,
            'montoTotal' => $montoTotal,
            'diasAtraso' => $diasAtraso,
            'comision' => $this->ChPagCom,
            'PylCod' => trim($this->PylCod),
            'CliNop' => $this->CliNop,
            'CliSec' => $this->CliSec,
            'ChRecSeg' => $this->ChRecSeg,
            'ChCiaSeg' => $this->ChCiaSeg,

        ];
    }
}
