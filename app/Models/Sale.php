<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['sales_id', 'amount'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }
}
