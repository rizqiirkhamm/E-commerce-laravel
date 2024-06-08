<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Toko;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $guarted = [];

    public function toko(): BelongsTo
   {
       return $this->belongsTo(Toko::class, 'id_toko');
   }

   public function kategori(): BelongsTo
   {
       return $this->belongsTo(Kategori::class, 'id_kategori');
   }

}
