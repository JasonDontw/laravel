@extends('layouts.default')
@section('title', '所有用戶')

@section('content')
<div class="col-md-offset-2 col-md-8">
  <h1>所有用户</h1>
  <ul class="users">
    @foreach ($users as $user)
      <li>
        @include('users._user')
      </li>
    @endforeach
  </ul>
  {!! $users->render() !!}  <!--頁面底下的選擇頁數-->
</div>    
@endsection