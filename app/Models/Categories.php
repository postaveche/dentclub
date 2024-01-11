<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = false;
    public function subcategory(){
        return $this->hasMany(self::class, 'id', 'category_id');
    }

    public function maincategory(){
        return $this->belongsTo(self::class, 'category_id', 'id');
    }
}
