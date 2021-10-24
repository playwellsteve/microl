@extends('layouts.main')

@section('content')
    {{ $customer->full_name }}
    <br>
    <h2 class="font-bold">Transaction Total:</h2> {{ $customer->formatted_transactions_total }}
@endsection
