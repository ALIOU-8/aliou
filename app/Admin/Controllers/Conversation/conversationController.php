<?php

namespace App\Admin\Controllers\Conversation;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Repository\ConversationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ConversationController extends Controller
{
    private $conversationRepository;

    public function __construct(ConversationRepository $conversationRepository)
    {
        $this->conversationRepository = $conversationRepository;
    }

    /**
     * Affiche la liste des conversations
     */
    public function index()
    {
        $userId = auth()->id();
        
        // Récupère tous les utilisateurs sauf l'utilisateur connecté
        $users = User::where('id', '!=', $userId)->get();
        
        // Compte les messages non lus
        $unread = $this->conversationRepository->unreadCount($userId);
       
        return view('Admin::conversation.conversation', [
            'users' => $users,
            'unread' => $unread
        ]);
    }



    /**
     * Envoie un nouveau message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'nullable|string|max:1000',
            'to_id' => 'required|integer|exists:users,id',
            'file' => 'nullable|file|max:10240',
        ]);
    
        // Debug: Vérification du fichier
        if ($request->hasFile('file')) {
            logger()->info('File upload attempt', [
                'valid' => $request->file('file')->isValid(),
                'size' => $request->file('file')->getSize()
            ]);
        }
    
        try {
            $filePath = null;
            $fileName = null;
            
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $file = $request->file('file');
                $filePath = $file->store('conversation_files', 'public');
                $fileName = $file->getClientOriginalName();
                
                logger()->info('File stored', [
                    'path' => $filePath,
                    'name' => $fileName
                ]);
            }
    
            
            $message = Message::create([
                'from_id' => auth()->id(),
                'to_id' => $validated['to_id'],
                'content' => $validated['content'] ?? null,
                'file_path' => $filePath,
                'file_name' => $fileName
            ]);
    
            logger()->info('Message created', $message->toArray());
            broadcast(new MessageSent($message))->toOthers(); 
    
            return back()->with('success', 'Message envoyé');
    
        } catch (\Exception $e) {
            logger()->error('Message creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Erreur lors de l\'envoi');
        }
    }

    /**
     * Récupère les messages d'une conversation
     */
 
    
    public function show(int $userId)
    {
        // Récupère l'utilisateur actuel
        $currentUserId = auth()->id();
        
        // 1. Liste des utilisateurs (pour la sidebar)
        $users = User::where('id', '!=', $currentUserId)->get();
        
        // 2. Messages de la conversation (PAGINÉS)
        $messages = Message::where(function($query) use ($currentUserId, $userId) {
                $query->where('from_id', $currentUserId)
                      ->where('to_id', $userId);
            })
            ->orWhere(function($query) use ($currentUserId, $userId) {
                $query->where('from_id', $userId)
                      ->where('to_id', $currentUserId);
            })
            ->orderBy('created_at', 'desc')
            ->with('from') // Charge les relations
            ->paginate(15);
    
        // 3. Messages non lus
        $unread = app(ConversationRepository::class)->unreadCount($currentUserId);
    
        return view('Admin::conversation.show', [
            'users' => $users,
            'user' => User::findOrFail($userId), // L'utilisateur avec qui on discute
            'messages' => $messages, // ← LA VARIABLE MANQUANTE
            'unread' => $unread
        ]);
    }
    /**
     * Marque tous les messages comme lus
     */
    public function markAsRead(int $userId)
    {
        $this->conversationRepository->readAllFrom($userId, Auth::id());
        
        return response()->json(['status' => 'success']);
    }

    /**
     * Récupère le nombre de messages non lus
     */
    public function unreadCount()
    {
        $unread = $this->conversationRepository->unreadCount(Auth::id());
        
        return response()->json([
            'status' => 'success',
            'unread' => $unread
        ]);
    }
 //modification des message
    public function update(Request $request, Message $message)
{
    $this->authorize('update', $message); // Vérifie que l'utilisateur peut modifier
    
    $validated = $request->validate([
        'content' => 'required|string|max:1000'
    ]);
    
    $message->update($validated);
    
    return response()->json(['success' => true]);
}

public function destroy(Message $message)
{
    $this->authorize('delete', $message); // Vérifie que l'utilisateur peut supprimer
    
    $message->delete();
    
    return response()->json(['success' => true]);
}
}