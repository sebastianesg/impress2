
@extends('cms/layouts/contentLayoutMaster')

@section('title', 'Chat Application')

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('cms/css/base/pages/app-chat.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('cms/css/base/pages/app-chat-list.css')) }}">
@endsection

@section('content-sidebar')
@include('cms/chat/chat-sidebar')
@endsection

@section('content')
<div class="body-content-overlay"></div>
<!-- Main chat area -->
<section class="chat-app-window">
    <!-- To load Conversation -->
    <div class="start-chat-area">
        <div class="mb-1 start-chat-icon">
            <i data-feather="message-square"></i>
        </div>
        <h4 class="sidebar-toggle start-chat-text">Start Conversation</h4>
    </div>
    <!--/ To load Conversation -->

  <!-- Active Chat -->
    <div class="active-chat d-none">
        <!-- Chat Header -->
        <div class="chat-navbar">
            <header class="chat-header">
                <div class="d-flex align-items-center">
                    <div class="sidebar-toggle d-block d-lg-none me-1">
                        <i data-feather="menu" class="font-medium-5"></i>
                    </div>
                    <div class="avatar avatar-border m-0 me-1">
                        <img src="{{asset('images/portrait/small/avatar-s-7.jpg')}}" alt="avatar" height="36" width="36" />
                    </div>
                    <h6 class="mb-0">Kristopher Candy</h6>
                </div>
            </header>
        </div>
        <!--/ Chat Header -->

        <!-- User Chat messages -->
        <div class="user-chats">
            <div class="chats"></div>
        </div>
        <!-- User Chat messages -->

        <!-- Submit Chat form -->
        <form class="chat-app-form" action="javascript:void(0);" onsubmit="enterChat();">
            @csrf
            <input type="hidden" name="to" id="to-uid">
            <div class="input-group input-group-merge me-1 form-send-message">
                <span class="speech-to-text input-group-text"><i data-feather="mic" class="cursor-pointer"></i></span>
                <input type="text" class="form-control message" placeholder="Type your message or use speech to text" name="message"/>
                <span class="input-group-text">
                    <label for="attach-doc" class="attachment-icon form-label mb-0">
                        <i data-feather="image" class="cursor-pointer text-secondary"></i>
                        <input type="file" id="attach-doc" name="file" onchange="enterChat();" hidden />
                    </label>
                </span>
            </div>
            <button type="button" class="btn btn-primary send" onclick="enterChat();">
                <i data-feather="send" class="d-lg-none"></i>
                <span class="d-none d-lg-block">Enviar</span>
            </button>
        </form>
    <!--/ Submit Chat form -->
    </div>
  <!--/ Active Chat -->
</section>
<!--/ Main chat area -->
@endsection

@section('page-script')
<!-- Page js files -->
<script>
let messagesUrl = '{{ route("chat.messages") }}';
let sendMessageUrl = '{{ route("chat.send") }}';
</script>
<script src="{{ asset(mix('cms/js/scripts/pages/app-chat.js')) }}"></script>
@endsection
