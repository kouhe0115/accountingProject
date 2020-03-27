{{-- 店舗トップページ --}}

@extends('layouts.app_shop')

@section('content')
  <h1>Shop Home</h1>
  @foreach ($shopInfos as $shop)
      {{ $shop->name }}
      {{ $shop->address }}
  @endforeach
  <a href="/shop/seats">席状況</a>
  <a href="/shop/slip">日報</a>
@endsection
