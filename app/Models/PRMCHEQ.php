<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PRMCHEQ extends Model
{
    use HasFactory;

    protected $table = 'PRMCHEQ';
    protected $primaryKey = 'PylCod';
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    public $incrementing = false;

    protected $fillable = [
        'PylCod',
        'CliNop',
        'CliSec',
        'PerCod',
        'ChRecNcu',
        'ChRecFvt',
        'ChCptId',
        'ChRecSer',
        'ChRecNrc',
        'ChSalAnt',
        'ChRecAmr',
        'ChRecAjt',
        'ChRecInt',
        'ChRecSeg',
        'ChRecCom',
        'ChPagFec'

    ];



    //protected $dateFormat = 'Y-m-d';

    //protected $dates = ['ChPagFec'];
}
