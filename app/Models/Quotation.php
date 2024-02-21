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
}
