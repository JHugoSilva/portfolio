<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return response()->json([
            'messages' => $messages
        ], 200);
    }

    public function changeStatus($id)
    {
        $message = Message::find($id);
        if ($message->status == '0') {
            $message->status = '1';
        } else {
            $message->status = '0';
        }
        $message->save();
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
    }
}
