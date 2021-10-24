<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use Carbon\Carbon;

class Customer extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'Customers';

    public $primaryKey = 'CustomerGUID';

    public function details()
    {
        return $this->hasOne(CustomerDetail::class, 'CustomerGUID', 'CustomerGUID');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'CustomerGUID', 'CustomerGUID');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'CustomerGUID', 'CustomerGUID');
    }

    public function completedTransactions()
    {
        return $this->hasMany(Transaction::class, 'CustomerGUID', 'CustomerGUID')->completed();
    }

    public function activeTransactions()
    {
        return $this->hasMany(Transaction::class, 'CustomerGUID', 'CustomerGUID')->active();
    }

    public function getFullNameAttribute()
    {
        return $this->sLastName . ', ' . $this->sFirstName;
    }

    public function TransactionsTotal()
    {
        return $this->completedTransactions->sum('dblAmount');
//        return $this->transactions->sum('dblAmount');
    }

    public function getMembershipMonthsAttribute()
    {
        return $this->activeTransactions()->max('iTotalActivePeriods');
    }

    public function getFormattedTransactionsTotalAttribute()
    {
        return $this->dollarFormat($this->TransactionsTotal());
    }

    protected function dollarFormat($amount)
    {
        $f = new \NumberFormatter("en-us", \NumberFormatter::CURRENCY);
        return $f->format($amount);
    }

    public function getLastJoinDateAttribute()
    {
        $lastJoin =  $this->activeTransactions()
            ->whereNotNull('dblAmount')
            ->where('lTransactionTypeId', 1)
            ->get()
            ->max('dtCreated');
        return Carbon::parse($lastJoin)->toFormattedDateString();
    }

    public function getLastSaleTransactionAttribute()
    {
        $sales = $this->transactions()->sale()->get();
        $maxSaleDate  =$sales->max('dtCreated');
        $lastSale = $this->transactions()->sale()->get()->where('dtCreated', $maxSaleDate);
        return $lastSale->first();
    }

    public function getLastAutochargeTransactionAttribute()
    {
        $autocharges = $this->transactions()->autocharge()->get();
        $maxAutochargeDate  =$autocharges->max('dtCreated');
        $lastAutocharge = $this->transactions()->autocharge()->get()->where('dtCreated', $maxAutochargeDate);
        return $lastAutocharge->first();
    }
}
