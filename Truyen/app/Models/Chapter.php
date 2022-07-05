<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Truyen;

class chapter extends Model
{
    use HasFactory;
    protected $fillable = [
        'truyen_id','tieude',
        'tomtat','noidung',
        'kichhoat','slug_chapter'
    ];

    public function truyen(){
        return $this->belongsTo(Truyen::class);
    }
}
