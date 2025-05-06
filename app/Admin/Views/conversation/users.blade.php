
<div class="col-md-3">
    <div class="list-group">

        @foreach($users as $user)
        <a class="list-group-item d-flex justify-content-between align-items-center" href="{{ route('conversation_show', $user->id) }}">
            {{ $user->name }}
            @if(isset($unread[$user->id]))
                
                    {{ $unread[$user->id] }}
                
            @endif
        </a>
        
       
        @endforeach
    </div>
</div>