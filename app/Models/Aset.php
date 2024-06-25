<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;
    protected $table = 'aset';
    protected $primarykey = 'id';
    protected $fillable = [
        'nama_aset', 'deskripsi_aset', 'kode_aset',
        'jumlah_aset', 'user_id', 'kategori_aset_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriAset::class, 'id');
    }
}
