<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producator;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = false;

    public function mycategory(){
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    public function myproducator(){
        return $this->belongsTo(Producator::class, 'producator_id', 'id');
    }
}

