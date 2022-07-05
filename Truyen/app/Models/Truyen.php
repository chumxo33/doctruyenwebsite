<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\chapter;
use App\Models\Theloai;

class Truyen extends Model
{
    use HasFactory;
    protected $fillable = [
        'tentruyen','tomtat',
        'danhmuc_id','image',
        'slug_truyen','kichhoat',
        'tacgia', 'theloai_id', 
        'views', 'truyen_noibat'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'danhmuc_id', 'id');
    }

    public function chapters(){
        return $this->hasMany(chapter::class, 'truyen_id', 'id');
    }
    // 1 truyên thuộc 1 thể loại
    public function theloai(){
        return $this->belongsTo(Theloai::class, 'theloai_id', 'id');
    }

    public function thuocnhieudanhmuctruyen(){
        return $this->belongsToMany(Category::class, 'thuocdanhmucs','truyen_id','danhmuc_id');
    }
    public function thuocnhieutheloaitruyen(){
        return $this->belongsToMany(Theloai::class, 'thuoctheloais','truyen_id', 'theloai_id');
    }
}

