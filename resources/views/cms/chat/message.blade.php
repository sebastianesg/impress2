@if ($left == 1)
<div class="chat chat-left">
    <div class="chat-avatar">
        <span class="avatar box-shadow-1 cursor-pointer">
            <img src="{{ $user->profile_photo_url }}" alt="avatar" height="36" width="36" />
        </span>
    </div>
    <div class="chat-body">
        @foreach ($msgs as $mg)
        <div class="chat-content">
            <p>
                @if (empty($mg->file))
                {{ $mg->message }}
                @else
                <a href="{{ $mg->getFile() }}" target="_blank" class=""><i data-feather="file-text"></i></a>
                @endif
            </p>
        </div>
        @endforeach
    </div>
</div>
@endif

@if ($day)
<div class="divider"><div class="divider-text">Yesterday</div></div>
@endif

@if ($left == -1)
<div class="chat">
    <div class="chat-avatar">
        <span class="avatar box-shadow-1 cursor-pointer">
            <img src="{{ $me->profile_photo_url }}" alt="avatar" height="36" width="36"/>
        </span>
    </div>
    <div class="chat-body">
        @foreach ($msgs as $mg)
        <div class="chat-content">
            <p>
                @if (empty($mg->file))
                {{ $mg->message }}
                @else
                <a href="{{ $mg->getFile() }}" target="_blank"><i data-feather="file-text"></i></a>
                @endif
            </p>
        </div>
        @endforeach
    </div>
</div>
@endif
