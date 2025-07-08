<?php

namespace App\Http\Controllers\Business\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Envia uma nova mensagem.
     */
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Retorna as mensagens entre o usuário autenticado e outro usuário.
     * Também marca as mensagens recebidas como lidas.
     */
    public function messages($userId)
    {
        $authId = auth()->id();

        Message::where('sender_id', $userId)
            ->where('receiver_id', $authId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::where(function ($q) use ($authId, $userId) {
            $q->where('sender_id', $authId)
                ->where('receiver_id', $userId);
        })->orWhere(function ($q) use ($authId, $userId) {
            $q->where('sender_id', $userId)
                ->where('receiver_id', $authId);
        })->orderBy('created_at', 'asc')->get();

        $messagesArr = $messages->map(function ($msg) {
            $user = $msg->sender; 
            return [
                'id' => $msg->id,
                'sender_id' => $msg->sender_id,
                'message' => $msg->message,
                'created_at' => $msg->created_at,
                'avatar' => $user && $user->image
                    ? 'data:image/png;base64,' . $user->image
                    : '/img/profile/image_profile.webp',
            ];
        });

        return response()->json($messagesArr);
    }


    /**
     * Lista todos os contatos (exceto o logado) e marca se há mensagens não lidas.
     */
    public function contacts()
    {
        $authId = auth()->id();
        $user = User::find($authId); // Obtém o usuário autenticado
        $users = User::where('id', '!=', $authId)->get();

        // Verifica se há mensagens não lidas de cada usuário
        foreach ($users as $contact) {
            $contact->unread_count = Message::where('sender_id', $contact->id)
                ->where('receiver_id', $authId)
                ->where('is_read', false)
                ->count();

            $contact->has_unread_messages = $contact->unread_count > 0;
        }
        return view('app.business.contacts', compact('user', 'users')); // Passa o usuário autenticado
    }

    public function checkMessages()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();

        foreach ($users as $contact) {
            $contact->unread_count = Message::where('sender_id', $contact->id)
                ->where('receiver_id', Auth::user()->id)
                ->where('is_read', false)
                ->count();

            $contact->has_unread_messages = $contact->unread_count > 0;
        }

        //    dd($users);

        return response()->json([
            'status' => 'success',
            'count' => $users
        ]);
    }
}
