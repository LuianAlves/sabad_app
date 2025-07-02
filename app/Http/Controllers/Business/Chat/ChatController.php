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

        // Marca como lidas todas as mensagens recebidas ainda não lidas
        Message::where('sender_id', $userId)
            ->where('receiver_id', $authId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Busca as mensagens entre os dois usuários
        $messages = Message::where(function ($q) use ($authId, $userId) {
            $q->where('sender_id', $authId)
                ->where('receiver_id', $userId);
        })->orWhere(function ($q) use ($authId, $userId) {
            $q->where('sender_id', $userId)
                ->where('receiver_id', $authId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
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

    public function checkMessages() {
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
