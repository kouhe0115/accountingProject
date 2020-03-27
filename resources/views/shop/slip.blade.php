{{-- 日報の表示 --}}

@extends('layouts.app_shop')

@section('content')
  <h1>Shop Slip</h1>
  
  <p>{{ $dailyTotalAccounting }}</p>

  @foreach ($todayOrders as $todayOrder)
      {{ $todayOrder->user->name }}
      {{ $todayOrder->order_name }}
      {{ $todayOrder->order_price }}
  @endforeach
@endsection
