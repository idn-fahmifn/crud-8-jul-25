<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table ='kategori';
    protected $guarded;

    // berelasi one to many = 1 kategori dimiliki oleh banyak buku

    public function buku()
    {
        return $this->hasMany(Buku::class, 'id_kategori');
    }

}
