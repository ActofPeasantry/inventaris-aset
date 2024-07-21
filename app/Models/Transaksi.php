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
        'user_id', 'tujuan_transaksi', 'tgl_transaksi',
        'invoice_transaksi', 'status_transaksi', 'supplier_id'
    ];

    protected $casts = [
        'tgl_transaksi' => 'date'
    ];

    public function getTransaksiDetail($transaksi_id)
    {
        return TransaksiDetail::where('transaksi_id', $transaksi_id)->with('aset')->get();
    }


    /**
     * Retrieves the years from the 'updated_at' column in the current model,
     * ordered in descending order, and returns them as an array of unique
     * year values.
     *
     * @return array An array of unique year values from the 'updated_at' column.
     */
    public function getYears()
    {
        $get_years = $this->orderBy('updated_at', 'DESC')->pluck('updated_at');

        $result = $get_years->map(function ($year) {
            return $year->format('Y');
        })->unique()->values()->toArray();

        return $result;
    }

    /**
     * Retrieve the transaction report for the current month and year.
     *
     * @return mixed
     */
    public function transReport()
    {
        $result = $this->where('invoice_transaksi', '!=', null)
            ->whereMonth('updated_at', date('m'))
            ->whereYear('updated_at', date('Y'))
            ->orderBy('updated_at', 'ASC')->get();

        return $result;
    }

    /**
     * Search for transaction reports based on selected purpose, month, and year.
     *
     * @param string $selected_purpose The selected purpose for the transaction report.
     * @param int $selecetd_month The selected month for the transaction report.
     * @param int $selected_year The selected year for the transaction report.
     * @return \Illuminate\Database\Eloquent\Collection The collection of transaction reports.
     */
    public function searchTransReport(string $selected_purpose, int $selected_month, int $selected_year)
    {
        // Initialize the query
        $query = $this->where('invoice_transaksi', '!=', null)
            ->whereYear('updated_at', $selected_year);

        // Dynamically add conditions to the query
        if ($selected_purpose != 0) {
            $query->where('tujuan_transaksi', $selected_purpose);
        }
        if ($selected_month != 0) {
            $query->whereMonth('updated_at', $selected_month);
        }

        // Get the results
        $result = $query->orderby('updated_at', 'ASC')->get();
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
