<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Pusher\Pusher;

class PusherController extends Controller
{
    
    public function sendNotification($datos)
    {
        //Remember to change this with your cluster name.
        $options = array(
            'cluster' => 'us2', 
            'encrypted' => false
        );
 
       //Remember to set your credentials below.
       $pusher = new Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        $options
      );
        
        $data= $datos;
        
        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('my-channel', 'my-event', $data);  
    }

}
