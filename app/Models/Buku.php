<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}

