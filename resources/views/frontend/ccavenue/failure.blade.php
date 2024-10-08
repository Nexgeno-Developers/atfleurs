@extends('frontend.layouts.app')

@section('content')
    <section class="mb-4 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-lg-left text-center">
                    <h1 class="fw-600 h4">{{ translate('Ccavenue failure') }}</h1>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb justify-content-center justify-content-lg-end bg-transparent p-0">
                        <li class="breadcrumb-item opacity-50">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            <a class="text-reset" href="">{{ translate('Ccavenue failure') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-4">
        <div class="container">
            <div class="rounded bg-white px-3 pt-3 shadow-sm">
                <div class="row row-cols-xxl-12 row-cols-xl-12 row-cols-lg-12 row-cols-md-12 row-cols-12 gutters-10">
                        <div class="col text-center">
                            <h3>Your Order Code is <b>{{$orderId}}</b></h3>
                            <p class="mb-0">{{$message}}</p>
                            <p><b class="text-danger">Note:</b> If any amount is deducted by the payment gateway, the system will confirm the order and you will receive an Email & SMS.</p>
                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection