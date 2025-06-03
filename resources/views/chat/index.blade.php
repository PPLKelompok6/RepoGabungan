@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Daftar Pengguna -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ auth()->user()->role === 'admin' ? 'Daftar Pasien' : 'Daftar Dokter' }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($users as $chatUser)
                            <a href="{{ route(auth()->user()->role === 'admin' ? 'admin.chat.index' : 'user.chat.index', ['user_id' => $chatUser->id]) }}" 
                               class="list-group-item list-group-item-action {{ $receiver_id == $chatUser->id ? 'active' : '' }}">
                                {{ $chatUser->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        Chat dengan: {{ $users->where('id', $receiver_id)->first()->name ?? 'Pilih pengguna' }}
                    </h5>
                </div>

                <div class="card-body">
                    <div class="chat-container" style="height: 400px; overflow-y: auto; margin-bottom: 20px;">
                        <div id="messages">
                            @foreach($messages as $message)
                                <div class="message {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                                    <strong>{{ $message->sender->name }}:</strong>
                                    <p>{{ $message->message }}</p>
                                    <small>{{ $message->created_at->format('H:i') }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if($receiver_id)
                        <form id="chat-form">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="message" id="message" class="form-control" placeholder="Ketik pesan...">
                                <input type="hidden" name="receiver_id" id="receiver_id" value="{{ $receiver_id }}">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-info">
                            Pilih pengguna untuk memulai chat
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .message {
        padding: 10px;
        margin: 5px;
        border-radius: 10px;
        max-width: 70%;
    }
    .sent {
        background-color: #007bff;
        color: white;
        margin-left: auto;
    }
    .received {
        background-color: #f8f9fa;
        margin-right: auto;
    }
    .list-group-item.active {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatForm = document.getElementById('chat-form');
        const messagesContainer = document.getElementById('messages');
        const messageInput = document.getElementById('message');
        const receiverId = document.getElementById('receiver_id')?.value;

        if (!receiverId) {
            console.log('No receiver selected');
            return;
        }

        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(chatForm);
            
            fetch('{{ route(auth()->user()->role === "admin" ? "admin.chat.send" : "user.chat.send") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const message = data.message;
                    const messageHtml = `
                        <div class="message sent">
                            <strong>${message.sender.name}:</strong>
                            <p>${message.message}</p>
                            <small>${new Date(message.created_at).toLocaleTimeString()}</small>
                        </div>
                    `;
                    messagesContainer.innerHTML += messageHtml;
                    messageInput.value = '';
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            });
        });

        // Auto-refresh messages every 5 seconds
        setInterval(function() {
            if (!receiverId) return;

            const messagesRoute = '{{ auth()->user()->role === "admin" ? route("admin.chat.messages", ["userId" => "__USERID__"]) : route("user.chat.messages", ["userId" => "__USERID__"]) }}'.replace('__USERID__', receiverId);
            
            fetch(messagesRoute)
                .then(response => response.json())
                .then(messages => {
                    messagesContainer.innerHTML = '';
                    messages.forEach(message => {
                        const messageHtml = `
                            <div class="message ${message.sender_id == {{ auth()->id() }} ? 'sent' : 'received'}">
                                <strong>${message.sender.name}:</strong>
                                <p>${message.message}</p>
                                <small>${new Date(message.created_at).toLocaleTimeString()}</small>
                            </div>
                        `;
                        messagesContainer.innerHTML += messageHtml;
                    });
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                });
        }, 5000);
    });
</script>
@endsection 