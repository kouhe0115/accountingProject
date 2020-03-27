{{-- 席情報の表示 --}}

@extends('layouts.app_shop')

@section('content')
  <h1>Shop Seats Status</h1>
  
  <p>{{ count($visitUsers) }}</p>

  @foreach ($visitUsers as $visitUser)
      <p>{{ $visitUser->user->name }}
        <a href="{{ route('shop.order', $visitUser->user_id) }}">オーダー状況</a>
      </p>
  @endforeach
@endsection
