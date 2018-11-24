<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title','sample.app')-Laravel教程</title><!--傳了兩個參數，第一個參數是該區塊的變量名稱，第二個參數是默認值，表示當指定變量的值為空值時，使用樣品來作為默認值。-->
    <link rel="stylesheet" href="/css/app.css">
  </head>
  @include('layouts._header')

  <div class="container">
      <div class="col-md-offset-1 col-md-10">
        @include('shared._messages')
        @yield('content')
        @include('layouts._footer')
      </div>
    </div>

    <script src="/js/app.js"></script> <!--下拉式菜單功能在app.js裡-->
</body>
</html>