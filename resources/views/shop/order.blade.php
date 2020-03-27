{{-- 個別オーダーの表示 --}}

@extends('layouts.app_shop')

@section('content')
  <h1>個別の注文状況</h1>

  @foreach ($orders as $order)
      <p>
        {{ $order->order_name }}
        {{ $order->order_price }}
      </p>
  @endforeach

  <p>
    合計
    {{ $userPrice }}
  </p>
@endsection
