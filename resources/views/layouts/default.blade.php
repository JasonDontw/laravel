<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title','sample.app')</title><!--傳了兩個參數，第一個參數是該區塊的變量名稱，第二個參數是默認值，表示當指定變量的值為空值時，使用樣品來作為默認值。-->
  </head>
  <body>
    @yield('content')
  </body>
</html>