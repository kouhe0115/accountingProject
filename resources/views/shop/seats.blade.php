{{-- 席情報の表示 --}}

@extends('layouts.app_shop')

@section('content')
  <h1>Shop Seats Status</h1>
  
  @foreach ($seatStatus as $seat)
      <p>{{ $seat->user_id }}</p>
  @endforeach
@endsection
