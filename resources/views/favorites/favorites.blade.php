<ul class="media-list">
@foreach ($favorites as $favorite)
    <?php $user = $favorite->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $favorite->created_at }}</span>
            </div>
            <div>
                <p>{!! nl2br(e($favorite->content)) !!}</p>
            </div>
            <div>
                @if (Auth::user()->id == $favorite->user_id)
                    {!! Form::open(['route' => ['microposts.destroy', $favorite->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
            <div>@if (Auth::user()->id != $user->id) 
                     @if (Auth::user()->is_favoriting($user->id))
                         {!! Form::open(['route' => ['user.unfavorites', $user->id], 'method' => 'delete']) !!}
                             {!! Form::submit('Unfavorite', ['class' => "btn btn-danger btn-block"]) !!}
                         {!! Form::close() !!}
                     @elses
                         {!! Form::open(['route' => ['user.favorites', $user->id]]) !!}
                             {!! Form::submit('Favorite', ['class' => "btn btn-primary btn-block"]) !!}
                         {!! Form::close() !!}
                     @endif
                 @endif
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $favorites->render() !!}
