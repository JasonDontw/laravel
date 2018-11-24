<!--在檔名前加 _ 為指定該視圖為局部視圖-->
<header class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
      <div class="col-md-offset-1 col-md-10">
        <a href="{{route('home')}}" id="logo">Sample App</a>
        <nav>
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
            <li><a href="#">用戶列表</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {{ Auth::user()->name }} <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('users.show', Auth::user()->id) }}">個人中心</a></li>
                <li><a href="#">編輯資料</a></li>
                <li class="divider"></li>
                <li>

                  <a id="logout" href="#">
                    <form action="{{ route('logout') }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-block btn-danger" type="submit" name="button">登出</button>
                    </form>
                  </a>

                </li>
              </ul>
            </li>

            @else
              <li><a href="{{ route('login') }}">登入</a></li>
              <li><a href="{{ route('help') }}">幫助</a></li>
            @endif

        </ul>
      </nav>
    </div>
  </div>
  </header>