<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Truyen;

class Theloai extends Model
{
    use HasFactory;

    protected $fillable = [
        'tentheloai', 'mota','kichhoat', 'slug_theloai',
    ];
    // 1 thể loại thì có nhiều truyện
    public function truyens(){
        return $this->hasMany(Truyen::class);
    }
    public function nhieutheloaitruyen(){
        return $this->belongsToMany(Truyen::class, 'thuoctheloais', 'theloai_id', 'truyen_id');
    }
}
