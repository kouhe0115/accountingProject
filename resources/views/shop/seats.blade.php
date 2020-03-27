{{-- 席情報の表示 --}}

@extends('layouts.app_shop')

@section('content')
  <h1>来店状況</h1>
  
  {{-- <p>{{ count($visitUsers) }}</p> --}}

  @foreach ($visitUsers as $visitUser)
      <p>{{ $visitUser->id }}</p>
      <p>{{ $visitUser->user->name }}
        <a href="{{ route('shop.order', $visitUser->user_id) }}">オーダー状況</a>
      </p>

      {!! Form::open(['route' => ['shop.check', $visitUser->id]]) !!}
      {!! Form::input('hidden', 'user_id', $visitUser->user_id, ['class' => '']) !!}
      {!! Form::submit('チェックする', ['class' => 'yes-btn']) !!}
      {!! Form::close() !!}
  @endforeach
@endsection
