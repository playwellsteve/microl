<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'CustomerDetails';

    public $primaryKey = 'lCustomerGUID';
}
