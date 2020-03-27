{{-- 個別オーダーの表示 --}}

@extends('layouts.app_shop')

@section('content')
  <h1>Shop Slip</h1>

  @foreach ($orders as $order)
      {{ $order->order_name }}
      {{ $order->order_price }}
  @endforeach

  <p>{{ $userPrice }}</p>
@endsection
