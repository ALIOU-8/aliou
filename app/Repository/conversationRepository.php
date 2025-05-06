<?php

namespace App\Repository;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ConversationRepository {

    private $user;
    private $message;

    public function __construct(User $user, Message $message){
        $this->user = $user;
        $this->message = $message;
    }

    public function getConversation(int $user)
    {
        $conversations = $this->user->newQuery()
            ->where('id', '!=', $user)
            ->get();
    
        return $conversations; // il faut retourner APRÈS la boucle, pas dedans !
    }
    

    //message
    public function message(
        ?string $content,
        int $from,
        int $to,
        ?string $filePath = null,
        ?string $fileName = null,
       
    ) {
        return $this->message->create([
            'content' => $content,
            'from_id' => $from,
            'to_id' => $to,
            'file_path' => $filePath,
            'file_name' => $fileName,
            // Utilisation de la valeur passée
        ]);
        logger()->info('Enregistrement DB:', $message->toArray());
    }

    public function getmessage( int $from, int $to):Builder
    {
        return $this->message->newQuery()
            ->whereRaw("((from_id=$from And to_id=$to)OR (from_id=$to And to_id=$from))")
            -> orderBy('created_at','DESC')
            -> with('from');  
          
     
            
    }
    /**
     * @param int $userId
     */

    public function unreadCount( int $userId)
    {
        return $this->message->newQuery()
            ->where('to_id',$userId)
            -> groupBy('from_id')
            -> selectRaw('from_id, count(id) as count')
            -> whereRaw('read_at is null')
            -> get()
            -> pluck('count','from_id');
            
    }
    public function readAllFrom( int $from,int $to)
    {
        return $this->message->newQuery()
            ->where('from_id',$from)
            ->where('to_id',$to)
            -> update(['read_at'=>Carbon::now()]);
            
            
    }
}
