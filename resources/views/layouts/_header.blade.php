<!--在檔名前加 _ 為指定該視圖為局部視圖-->
<header class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
      <div class="col-md-offset-1 col-md-10">
        <a href="{{route('home')}}" id="logo">Sample App</a>
        <nav>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">登入</a></li>
            <li><a href="{{route('help')}}">幫助</a></li>          
          </ul>
        </nav>
      </div>
    </div>
  </header>