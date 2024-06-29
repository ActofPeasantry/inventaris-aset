<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengesahanTransaksi extends Model
{
    use HasFactory;
    protected $table = 'pengesahan_transaksi';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'transaksi_id',  'status_pengesahan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
