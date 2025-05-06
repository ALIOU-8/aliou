@extends('Admin::layout')
@section('content')
<main>
    <ul class="breadcrumbs">
        <li><a href="">Home</a></li>
        <li class="divider">/</li>
        <li><a href="" class="active">Profil</a></li>
    </ul>
    <div class="container">
        <div class="row pt-4">
            {{-- @include('conversation.show', ['users' => $users, 'unread' => $unread]) --}}
        
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Conversation avec {{ $user->name }}
                    </div>
                    
                    <div class="card-body messages-container position-relative" style="max-height: 500px; overflow-y: auto;">
                        <!-- Pagination haut -->
                        @if($messages->hasMorePages())
                            <div class="text-center mb-3">
                                <a href="{{ $messages->nextPageUrl() }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-arrow-up"></i> Voir les messages précédents
                                </a>
                            </div>
                        @endif
    
                        <!-- Messages -->
                        @foreach(array_reverse($messages->items())  as $message)
                            <div class="message-bubble position-relative {{ $message->from_id === auth()->id() ? 'sent' : 'received' }}"
                                 oncontextmenu="showMessageMenu(event, {{ $message->id }}, {{ $message->from_id === auth()->id() ? 'true' : 'false' }})"
                                 data-message-id="{{ $message->id }}">
                                
                                @if($message->content)
                                    <div class="message-content">{{ $message->content }}</div>
                                    <small class="text-muted d-block text-end">{{ $message->created_at->diffForHumans() }}</small>
                                    @endif
                                    
                                    @if($message->file_path)
                                    <div class="file-attachment mt-2">
                                        <a href="{{ Storage::url($message->file_path) }}" target="_blank" download="{{ $message->file_name }}">
                                            <i class="fas fa-file-alt me-2"></i>
                                            {{ $message->file_name }}
                                        </a>
                                    </div>
                                    @endif
                                    <div class="message-status d-flex justify-content-end align-items-center gap-2 mt-1">
                                        <!-- Heure d'envoi -->
                                        <small class="text-muted opacity-75">{{ $message->created_at->format('H:i') }}</small>
                                        
                                        <!-- Indicateurs de statut -->
                                        @if($message->from_id === auth()->id())
                                            <span class="message-read-status">
                                                @if($message->status === 'read')
                                                    <i class="fas fa-check-double text-primary" data-bs-toggle="tooltip" title="Lu"></i>
                                                @elseif($message->status === 'delivered')
                                                    <i class="fas fa-check-double text-muted" data-bs-toggle="tooltip" title="Reçu"></i>
                                                @else
                                                    <i class="fas fa-check text-muted" data-bs-toggle="tooltip" title="Envoyé"></i>
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                            </div>
                        @endforeach
    
                      
                        <!-- Pagination bas -->
                        @if($messages->previousPageUrl())
                            <div class="text-center mt-3">
                                <a href="{{ $messages->previousPageUrl() }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-arrow-down"></i> Voir les messages suivants
                                </a>
                            </div>
                        @endif
                    </div>
    
                    <!-- Formulaire d'envoi -->
                    <div class="card-footer">
                        <form action="{{ route('conversation_store', $user->id) }}" method="POST"  enctype="multipart/form-data" class="message-form" >
                            @csrf
                            <div class="input-group">
                                <input type="hidden" name="to_id" value="{{ $user->id }}">  <!-- Important -->
                                <textarea name="content" 
                                          class="form-control" 
                                          placeholder="Écrivez votre message..."
                                          rows="2"
                                          required></textarea>
                                          <div class="form-group mt-2">
                                            <input type="file" name="file" id="fileInput" class="form-control-file d-none">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('fileInput').click()">
                                                <i class="fas fa-paperclip"></i> Joindre un fichier
                                            </button>
                                            <span id="fileName" class="ms-2 small text-muted"></span>
                                        </div>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-paper-plane"></i> Envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    
    <style>
        .message-bubble {
            padding: 10px 15px;
            border-radius: 18px;
            margin-bottom: 15px;
            max-width: 70%;
            position: relative;
            cursor: context-menu;
        }
        
        .sent {
            background-color: #007bff;
            color: white;
            margin-left: auto;
        }
        
        .received {
            background-color: #f1f1f1;
            margin-right: auto;
        }
        
        .edit-container {
            z-index: 1050;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 400px;
        }
        
        .messages-container {
            scroll-behavior: smooth;
        }
    </style>
    
    <script>
     <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Initialisation de Pusher/Echo
        const userId = {{ auth()->id() }};
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ config('broadcasting.connections.pusher.key') }}',
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            encrypted: true
        });
    
     
        Echo.private(`chat.${userId}`)
            .listen('MessageSent', (e) => {
                const message = e.message;
                const isSender = message.from_id === userId;
                
                // Ajout du nouveau message à l'interface
                const messagesContainer = document.querySelector('.messages-container');
                const messageHtml = `
                    <div class="message-bubble position-relative ${isSender ? 'sent' : 'received'}" 
                         data-message-id="${message.id}">
                        ${message.content ? `<div class="message-content">${message.content}</div>` : ''}
                        ${message.file_path ? `
                            <div class="file-attachment mt-2">
                                <a href="/storage/${message.file_path}" target="_blank" download="${message.file_name}">
                                    <i class="fas fa-file-alt me-2"></i>
                                    ${message.file_name}
                                </a>
                            </div>
                        ` : ''}
                        <div class="message-status">
                            <small class="text-muted">${new Date(message.created_at).toLocaleTimeString()}</small>
                            ${isSender ? `
                                <i class="fas fa-check${message.status === 'read' ? '-double text-primary' : ''}"></i>
                            ` : ''}
                        </div>
                    </div>
                `;
                
                messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            });
    
        // Gestion de l'envoi de formulaire
        document.querySelector('.message-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                if (response.ok) {
                    this.reset();
                    document.getElementById('fileName').textContent = '';
                }
            } catch (error) {
                console.error('Erreur:', error);
            }
        });
    
        // Gestion des statuts
        function updateMessageStatus(messageId, status) {
            const messageElement = document.querySelector(`.message-bubble[data-message-id="${messageId}"]`);
            if (messageElement) {
                const checkIcon = messageElement.querySelector('.fa-check');
                if (checkIcon) {
                    checkIcon.className = status === 'read' 
                        ? 'fas fa-check-double text-primary' 
                        : 'fas fa-check-double';
                }
            }
        }
    
        // Marquer comme lu quand visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const messageId = entry.target.dataset.messageId;
                    markAsRead(messageId);
                }
            });
        }, { threshold: 0.5 });
    
        document.querySelectorAll('.message-bubble').forEach(bubble => {
            if (bubble.classList.contains('received')) {
                observer.observe(bubble);
            }
        });
    
        async function markAsRead(messageId) {
            await fetch(`/messages/${messageId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            });
        }
    </script>
    </script>
</main> 
@endsection