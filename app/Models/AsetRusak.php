<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetRusak extends Model
{
    use HasFactory;
    protected $table = 'aset_rusak';
    protected $primarykey = 'id';
    protected $fillable = ['jumlah_aset_rusak', 'aset_id', 'user_id',  'keterangan', 'status_pengesahan'];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
