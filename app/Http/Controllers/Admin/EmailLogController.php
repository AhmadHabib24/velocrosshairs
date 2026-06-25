<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    public function unread()
    {
        $emails = EmailLog::latest()->take(10)->get();
        $unreadCount = EmailLog::where('is_read', false)->count();

        $formatted = $emails->map(function ($email) {
            return [
                'id' => $email->id,
                'title' => $email->subject ?: 'No Subject',
                'message' => 'To: ' . $email->to_email,
                'created_at' => $email->created_at,
                'is_read' => $email->is_read,
                'link' => route('admin.emails.show', $email->id),
                'icon' => 'fas fa-envelope',
                'color' => 'info'
            ];
        });

        return response()->json([
            'emails' => $formatted,
            'unread_count' => $unreadCount
        ]);
    }

    public function show($id)
    {
        $email = EmailLog::findOrFail($id);
        $email->update(['is_read' => true]);
        
        return view('admin.emails.show', compact('email'));
    }

    public function readAll()
    {
        EmailLog::where('is_read', false)->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}
