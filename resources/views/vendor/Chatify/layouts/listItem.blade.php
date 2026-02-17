{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    @php
        $chatUser = Auth::user() ?? (object) session('guest_user');
    @endphp
    <table class="messenger-list-item" data-contact="{{ $chatUser->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div class="saved-messages avatar av-m">
                    <span class="far fa-bookmark"></span>
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $chatUser->id }}" data-type="user">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Contact list -------------------- --}}
@if($get == 'users' && !!$lastMessage)
@php
    $chatUser = Auth::user() ?? (object) session('guest_user');
    $lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
    $lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
@endphp
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status ?? false)
                <span class="activeStatus"></span>
            @endif
            <div class="avatar av-m"
                style="background-image: url('{{ $user->avatar ?? 'https://via.placeholder.com/150' }}');">
            </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
                {{ strlen($user->name ?? 'Guest') > 12 ? trim(substr($user->name ?? 'Guest',0,12)).'..' : ($user->name ?? 'Guest') }}
                <span class="contact-item-time" data-time="{{ $lastMessage->created_at }}">{{ $lastMessage->timeAgo }}</span>
            </p>
            <span>
                {{-- Last Message user indicator --}}
                {!! ($lastMessage->from_id ?? null) == $chatUser->id ? '<span class="lastMessageIndicator">You :</span>' : '' !!}
                {{-- Last message body --}}
                @if($lastMessage->attachment == null)
                    {!! $lastMessageBody !!}
                @else
                    <span class="fas fa-file"></span> Attachment
                @endif
            </span>
            {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
    </tr>
</table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>
            <div class="avatar av-m"
                style="background-image: url('{{ $user->avatar ?? 'https://via.placeholder.com/150' }}');">
            </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
                {{ strlen($user->name ?? 'Guest') > 12 ? trim(substr($user->name ?? 'Guest',0,12)).'..' : ($user->name ?? 'Guest') }}
            </p>
        </td>
    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image ?? '' }}')"></div>
@endif
