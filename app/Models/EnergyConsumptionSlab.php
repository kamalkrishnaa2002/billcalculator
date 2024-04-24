<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnergyConsumptionSlab extends Model
{
    protected $fillable = ['start_units', 'end_units', 'rate'];
}
