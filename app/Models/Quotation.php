<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    public function detailQuotations()
    {
        return $this->hasMany(DetailQuotation::class);
    }

    function subtotal($id) 
    {
        $detailQuotation = DetailQuotation::where('quotation_id', $id)->get();
        $subtotal = 0;
        foreach ($detailQuotation as $value) {
            $subtotal = $subtotal + ($value->amount + (($value->amount * $value->markup) / 100));
        }
        return $subtotal;
    }
}
