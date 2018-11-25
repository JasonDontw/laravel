    <li>
        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
        <a href="{{ route('users.show', $user->id )}}" class="username">{{ $user->name }}</a>
    
        
          <form action="{{ route('users.destroy', $user) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            @if(Auth::User()->id !== $user->id) <!--不可以刪除自己-->
            <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
            @endif

          </form>
        
    </li>