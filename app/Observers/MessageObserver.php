<?php

namespace App\Observers;
use App\Events\MessageSent;
use App\Message;
use App\Conversation;
class MessageObserver
{
    /*
        Cuando se inicia una conversación se crea dos registro en ambos sentido del usuario
        Esos dos sentidos debemos de actualizar cada vez que se crea una conversación 
    */
    public function created(Message $message){
        
        // Selecciono la  conversacion
        $conversation = Conversation::where('user_id',$message->from_id)->where('contact_id',$message->to_id)->first();
        // Procedo a actualizar la conversación
        if($conversation){
          $conversation->last_message = "Tú : ".$message->content;
          $conversation->last_time = $message->created_at;
          $conversation->save();
        }

        // Ahora procedo a actualizar en el sentido opuesto a la conversación

        $conversation = Conversation::where('user_id',$message->to_id)->where('contact_id',$message->from_id)->first();
        // Procedo a actualizar la conversación
        if($conversation){
          $conversation->last_message = "El : ".$message->content;
          $conversation->last_time = $message->created_at;
          $conversation->save();
        }
        
        // Evento message para la  herramienta pusher. Informar notificaciones en tiempo real 
        event(new MessageSent($message));

    }
}
