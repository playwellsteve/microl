<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Inertia\Inertia;


class CustomersController extends Controller
{
    //
    public function show(Customer $customer)
    {
//        dd($customer->transactions->sum('dblAmount'));
//        dd($customer->last_autocharge_transaction->dblAmount);
        $customerArray = [
            'full_name' => $customer->sLastname . ', ' . $customer->sFirstName,
            'formatted_transactions_total' => $customer->formatted_transactions_total,
            'membership_months' => $customer->membership_months,
            'last_join_date' => $customer->last_join_date,
            'last_recharge_price' => $customer->last_autocharge_transaction->dblAmount,
        ];

        return Inertia::render('Customers/Show',['customer' => $customerArray]);
//        return view('customers.show', ['customer' => $customer]);

    }
}
