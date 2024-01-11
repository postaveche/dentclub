<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $guarded = false;

    public function subtag(){
        return $this->hasMany(self::class, 'id', 'tag_id');
    }

    public function maintag(){
        return $this->belongsTo(self::class, 'tag_id', 'id');
    }
}
