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

    public function transReport()
    {
        $result = $this->where('invoice_transaksi', '!=', null)
            ->whereMonth('updated_at', date('m'))
            ->whereYear('updated_at', date('Y'))
            ->orderBy('updated_at', 'ASC')->get();

        return $result;
    }

    public function getYears()
    {
        $get_years = $this->orderBy('updated_at', 'DESC')->pluck('updated_at');

        $result = $get_years->map(function ($year) {
            return $year->format('Y');
        })->unique()->values()->toArray();

        return $result;
    }

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

    public function transaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}
