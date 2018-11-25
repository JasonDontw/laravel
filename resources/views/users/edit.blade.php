@extends('layouts.default')
@section('title','編輯')
@section('content')
<div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5>編輯個人資料</h5>
          </div>
            <div class="panel-body">
      
              @include('shared._errors')
      
              <div class="gravatar_edit">
                <a href="http://gravatar.com/emails" target="_blank">
                  <img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" class="gravatar"/>
                </a>
              </div>
      
              <form method="POST" action="{{ route('users.update', $user->id )}}"> <!--<form method="POST" action="http://sample.test/users/1">-->
                  {{ method_field('PATCH') }}
                  {{ csrf_field() }}
      
                  <div class="form-group">
                    <label for="name">名稱：</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                  </div>
      
                  <div class="form-group">
                    <label for="email">信箱：</label>
                    <input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
                  </div>
      
                  <div class="form-group">
                    <label for="password">新密碼：</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                  </div>
      
                  <div class="form-group">
                    <label for="password_confirmation">確認密碼：</label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                  </div>
      
                  <button type="submit" class="btn btn-primary">更新</button>
              </form>
          </div>
        </div>
      </div>


@endsection