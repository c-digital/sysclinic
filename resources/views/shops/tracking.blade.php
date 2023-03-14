@extends('layouts.shop')

@section('content')

    <div class="card">
        <div class="card-body">

            <div class="container">
                <div class="row align-items-center mb-4 invoice mt-2">
                    <div class="col invoice-details">
                        <img width="150px" src="{{ '/storage/shops/logos/' . $shop->logo }}" alt="">
                        <h1 class="invoice-id h6">Invoice Nro: {{ $user->posNumberFormat($pos->pos_id) }}</h1>
                        <div class="date"><b>{{ __('Date') }}: </b>{{ $pos->pos_date }}</div>
                        <div class="date"><b>{{ __('Status') }}: </b>{{ $pos->order_status }}</div>
                    </div>
                </div>
                <div class="row invoice mt-2">
                    <div class="col contacts d-flex justify-content-between pb-4">
                        <div class="invoice-to">
                            <div class="text-dark h6"><b>{{ __('Billed To :') }}</b></div>
                            {{$customer->billing_name}}<br>
                            {{$customer->billing_phone}}<br>
                            {{$customer->billing_address}}<br>
                            {{$customer->billing_city . ', ' . $customer->billing_state . ', ' . $customer->billing_country }}
                        </div>

                        <div class="invoice-to">
                            <div class="text-dark h6"><b>{{ __('Shipped To :') }}</div>
                            {{$customer->shipping_name}}<br>
                            {{$customer->shipping_phone}}<br>
                            {{$customer->shipping_address}}<br>
                            {{$customer->shipping_city . ', ' . $customer->shipping_state . ', ' . $customer->shipping_country }}
                        </div>

                        <div class="company-details">
                            <div class="text-dark h6"><b>{{ __('From:') }}</b></div>
                            {{ $shop->name }}<br>
                            {{ $shop->phone }}<br>
                            {{ $shop->email }}<br>
                            {{ $shop->address }}<br>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                        <div class="invoice-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left">{{ __('Items') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th class="text-right">{{ __('Price') }}</th>
                                        <th class="text-right">{{ __('Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posProducts as $product)
                                        <tr>
                                            <td class="cart-summary-table text-left">
                                                {{ $product->name() }}

                                                <div>
                                                    @if($product->parameters)
                                                        |
                                                        @foreach(json_decode($product->parameters) as $key => $value)

                                                            @php
                                                                $additional = null;

                                                                if (in_array($value, array_column(json_decode($product->parameters_prices, true), 'name'))) {

                                                                    $i = array_search(
                                                                        $value,
                                                                        array_column(json_decode($product->parameters_prices, true), 'name'),
                                                                        $product->parameters_prices
                                                                    );

                                                                    $additional = json_decode($product->parameters_prices, true)[$i]['price'];
                                                                }
                                                            @endphp

                                                            <small>{{$key . ': ' . $value}} @if($additional)(+ Bs. {{ $additional }})@endif </small> |
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="cart-summary-table">
                                                {{ $product->quantity }}
                                            </td>
                                            <td class="text-right cart-summary-table">
                                                {{ isset($additional) ? $product->price + $additional : $product->price }}
                                            </td>
                                            <td class="text-right cart-summary-table">
                                                {{ isset($additional)
                                                        ? number_format(($product->price * $product->quantity) + ($additional * $product->quantity), 2)
                                                        : number_format($product->price * $product->quantity, 2)
                                                }}
                                            </td>
                                        </tr>

                                        @php
                                            if (isset($additional)) {
                                                $total = $total + ($product->price * $product->quantity) + ($additional * $product->quantity);
                                            } else {
                                                $total = $total + ($product->price * $product->quantity);
                                            }
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-left font-weight-bold">{{ __('Total') }}</td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right font-weight-bold">{{ number_format($total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

            </div>
        </div>

    </div>
@endsection()