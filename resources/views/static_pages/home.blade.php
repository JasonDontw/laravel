@extends('layouts.default')
@section('title','主頁')

@section('content')
@if (Auth::check())
    <div class="row">
      <div class="col-md-8">
        <section class="status_form">
          @include('shared._status_form')
        </section>
        <h3>微博列表</h3>
        @include('shared._feed')
      </div>
      <aside class="col-md-4">
        <section class="user_info">
          @include('shared._user_info', ['user' => Auth::user()])
        </section>
      </aside>
    </div>
  @else
<div class="jumbotron">
    <h1>Hello Laravel</h1>
    <p class="lead">
      你现在所看到的是 <a href="https://laravel-china.org/courses/laravel-essential-training-5.5">Laravel 入門教程</a> 的範例主頁。
    </p>
    <p>
      一切，將從這裡開始。
    </p>
    <p>
    <a class="btn btn-lg btn-success" href="{{route('signup')}}" role="button">現在註冊</a>
    </p>
  </div>
  @endif
@endsection