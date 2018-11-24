@extends('layouts.default')
@section('title','註冊')
@section('content')
<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h5>注册</h5>
      </div>
      <div class="panel-body">

        @include('shared._errors')

        <form method="POST" action="{{ route('users.store') }}">
            {{ csrf_field() }} <!--PHP傳值必須內建的指令用於防止駭客串改-->
            <div class="form-group">
              <label for="name">名稱：</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}"> <!--Old是取name就的資料也就是說如果輸入錯誤舊資料就是輸入錯誤的值-->
            </div>
  
            <div class="form-group">
              <label for="email">電子郵件：</label>
              <input type="text" name="email" class="form-control" value="{{ old('email') }}">
            </div>
  
            <div class="form-group">
              <label for="password">密碼：</label>
              <input type="password" name="password" class="form-control" value="{{ old('password') }}">
            </div>
  
            <div class="form-group">
              <label for="password_confirmation">確認密碼：</label>
              <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
            </div>
  
            <button type="submit" class="btn btn-primary">註冊</button>
        </form>
      </div>
    </div>
  </div>
@endsection