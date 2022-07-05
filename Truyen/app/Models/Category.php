<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Truyen;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'tendanhmuc', 'motadanhmuc','kichhoat', 'slug_danhmuc','image',
    ];

    public function truyens(){
        return $this->hasMany(Truyen::class);
    }

    public function nhieutruyen(){
        return $this->belongsToMany(Truyen::class, 'thuocdanhmucs', 'danhmuc_id', 'truyen_id');
    }


    
}
