<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv';
    protected $table = 'Tickets';

    public $primaryKey = 'TicketGUID';
}
