{{-- 日報の表示 --}}

@extends('layouts.app_shop')

@section('content')
  <h1>日報</h1>

  @foreach ($todayUserTotalAccounting as $todayUserTotalAccounting)
      <p>
        {{ $todayUserTotalAccounting->user_id }}
        {{ $todayUserTotalAccounting->order_price }}
      </p>
  @endforeach

  <p>今日の合計</p>
  {{ $dailyTotalAccounting }}
@endsection
