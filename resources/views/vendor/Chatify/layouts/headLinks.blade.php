<title>{{ config('chatify.name') }}</title>

{{-- Meta tags --}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="id" content="{{ $id ?? '' }}">
<meta name="messenger-color" content="{{ $messengerColor ?? session('guest_user.messenger_color') }}">
<meta name="messenger-theme" content="{{ $dark_mode ?? 'light' }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Chatify URL and user data --}}
@php
    $chatUser = Auth::user() ?? (object) session('guest_user');
@endphp
<meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ $chatUser->id }}">

{{-- scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
<script src="{{ asset('js/chatify/autosize.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

{{-- styles --}}
<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
<link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/chatify/'.($dark_mode ?? 'light').'.mode.css') }}" rel="stylesheet" />
<link href="{{ asset('css/app.css') }}" rel="stylesheet" />

{{-- Setting messenger primary color to css --}}
<style>
    :root {
        --primary-color: {{ $messengerColor ?? session('guest_user.messenger_color') }};
    }
</style>
