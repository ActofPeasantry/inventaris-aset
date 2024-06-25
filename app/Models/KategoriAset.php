<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    use HasFactory;
    protected $table = 'kategori_aset';
    protected $primarykey = 'id';
    protected $fillable = ['nama_kategori', 'tipe_kategori'];

    public function aset()
    {
        return $this->hasMany(Aset::class);
    }
}
