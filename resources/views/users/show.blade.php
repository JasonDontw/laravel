@extends('layouts.default')
@section('title',$user->name)
@section('content')

<div class="row">
    <div class="col-md-offset-2 col-md-8">
      <div class="col-md-12">
        <div class="col-md-offset-2 col-md-8">
          <section class="user_info">
            @include('shared._user_info', ['user' => $user])<!--用user這個名稱取代$user然後丟給shared._user_info使用-->
          </section>                                        <!--也可以不用替代名稱直接[$user]-->
        </div>
      </div>
    </div>
  </div>
@endsection