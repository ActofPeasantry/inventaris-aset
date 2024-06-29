<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primarykey = 'id';
    protected $fillable = [
        'user_id', 'tujuan_transaksi', 'invoice_transaksi',
        'status_transaksi', 'supplier_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function pengesahanTransaksi()
    {
        return $this->hasOne(PengesahanTransaksi::class, 'transaksi_id');
    }
}
