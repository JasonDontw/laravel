<li id="status-{{ $status->id }}">
        <span class="timestamp">
          {{ $status->created_at->diffForHumans() }}
        </span>
        <span class="content">{{ $status->content }}</span>
        @if($user->id === $status->user_id)
        
            <form action="{{ route('statuses.destroy', $status->id) }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-sm btn-danger status-delete-btn">删除</button>
            </form>
        @endif
      </li>