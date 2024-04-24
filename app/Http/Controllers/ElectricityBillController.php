<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TelescopicRate;
use App\Models\NonTelescopicRate;

class ElectricityBillController extends Controller
{
    public function calculateElectricityBill(Request $request)
    {
        $units = $request->input('units');
    
        
        $billAmount = null;
    
       
        if ($units <= 250) {
            
            $billAmount = $this->calculateTelescopicRate($units);
        } else {
          
            $billAmount = $this->calculateNonTelescopicRate($units);
            $billAmount = number_format($billAmount, 2, '.', '');
        }

       
    
        return response()->json(['success' => true, 'bill_amount' => $billAmount]);
    }
    

    private function calculateTelescopicRate($units)
{
    $fixedCharge = 20.0; 
    
    $slabs = TelescopicRate::orderBy('start_units')->get();
    
    $totalAmount = $fixedCharge;
    $slabDetails = [];
    
    foreach ($slabs as $slab) {
        $slabUnits = min($slab->end_units, $slab->end_units - $slab->start_units + 1);
    
        $slabAmount = $slabUnits * $slab->rate;

        $slabInfo = [
            'start_units' => $slab->start_units,
            'end_units' => $slab->end_units,
            'rate' => $slab->rate,
            'units_consumed' => $slabUnits,
            'slab_amount' => $slabAmount,
        ];

        $slabDetails[] = $slabInfo;

        $totalAmount += $slabAmount;

        $units -= $slabUnits;

        if ($units <= 0) {
            break;
        }
    }
   
    // Format total amount to have even decimal places
    $totalAmount = number_format($totalAmount, 2, '.', '');
    
    return $totalAmount;
}

    private function calculateNonTelescopicRate($units)
    {
        $fixedCharge = 35;
    
       
        $slab = NonTelescopicRate::where('start_units', '<=', $units)
            ->where(function (Builder $query) use ($units) {
                $query->where('end_units', '>=', $units)
                    ->orWhereNull('end_units');
            })
            ->first();
    
       
    
        if (!$slab) {
           
            return $fixedCharge;
        }
    
       
        if ($slab->end_units === null) {

            $totalAmount = $units * $slab->rate;
        } else {
           
            $slabUnits = $units - $slab->start_units + 1;
            $totalAmount = $slabUnits * $slab->rate;
        }
    
       
        return $totalAmount + $fixedCharge;
    }
    
}