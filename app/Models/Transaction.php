<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'CustomerUnlimitedTransactions';

    public $primaryKey = 'lTransactionID';


    public function scopeCompleted($query)
    {
        return $query->whereIn('lTransactionTypeId', [1,5])->where('bMonthlyHold', 0);
    }

    public function scopeActive($query)
    {
        return $query->where('bMonthlyActive', 1);
    }

    public function scopeSale($query)
    {
        return $query->where('lTransactionTypeId', 1)->where('bMonthlyActive', 1);
    }

    public function scopeAutocharge($query)
    {
        return $query->where('lTransactionTypeId', 5)->where('bMonthlyActive', 1);
    }
}
