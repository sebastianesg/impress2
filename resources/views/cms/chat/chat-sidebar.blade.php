<!-- Chat Sidebar area -->
<div class="sidebar-content">
    <span class="sidebar-close-icon">
        <i data-feather="x"></i>
    </span>
    <!-- Sidebar header start -->
    <div class="chat-fixed-search">
        <div class="d-flex align-items-center w-100">
            <div class="">
                <div class="avatar avatar-border">
                <img src="{{Auth::user()->profile_photo_url}}" alt="user_avatar" height="42" width="42"/>
                </div>
            </div>
            <div class="input-group input-group-merge ms-1 w-100">
                <span class="input-group-text round"><i data-feather="search" class="text-muted"></i></span>
                <input type="text" class="form-control round" id="chat-search" placeholder="Buscar..." aria-label="Buscar..." aria-describedby="chat-search"/>
            </div>
        </div>
    </div>
  <!-- Sidebar header end -->

  <!-- Sidebar Users start -->
    <div id="users-list" class="chat-user-list-wrapper list-group">
        <h4 class="chat-list-title">Chats</h4>
        <ul class="chat-users-list chat-list media-list">
            @foreach ($chats as $chat)
            <li data-id="{{ $chat->getAnyUser()->id }}">
                <span class="avatar"><img src="{{ $chat->getAnyUser()->profile_photo_url }}" height="42" width="42" alt="Generic placeholder image"/></span>
                <span class="avatar-status-offline"></span>
                <div class="chat-info flex-grow-1">
                    <h5 class="mb-0">{{ $chat->getAnyUser()->name }}</h5>
                    <p class="card-text text-truncate">{{ $chat->message }}</p>
                </div>
                <div class="chat-meta text-nowrap">
                    <small class="float-end mb-25 chat-time">{{ $chat->getDate() }}</small>
                    @if ($chat->getPending() != 0) <span class="badge bg-danger rounded-pill float-end">{{ $chat->getPending() }}</span> @endif
                </div>
            </li>
            @endforeach
            <li class="{{ count($chats) != 0 ? 'no-results' : 'no-rr' }}">
                <h6 class="mb-0">No hay chats</h6>
            </li>
        </ul>

        <h4 class="chat-list-title">Contactos</h4>
        <ul class="chat-users-list contact-list media-list">
            @foreach ($contacts as $cc)
            <li data-id="{{ $cc->id }}">
                <span class="avatar"><img src="{{ $cc->profile_photo_url }}" height="42" width="42" alt="Generic placeholder image"/></span>
                <div class="chat-info">
                    <h5 class="mb-0">{{ $cc->name }}</h5>
                    <p class="card-text text-truncate"></p>
                </div>
            </li>
            @endforeach
            <li class="no-results">
                <h6 class="mb-0">No hay contactos</h6>
            </li>
        </ul>
    </div>
  <!-- Sidebar Users end -->
</div>
<!--/ Chat Sidebar area -->
