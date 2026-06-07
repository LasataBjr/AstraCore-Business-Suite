<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * LIST + FILTER
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // search filter
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }

        // status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $messages = $query->latest()->paginate(10);

        return view('admin.contact-messages.index', compact('messages'));
    }

    /**
     * SHOW SINGLE MESSAGE
     */
    public function show(ContactMessage $contactMessage)
    {
        // auto mark as read
        if ($contactMessage->status === 'new') {
            $contactMessage->update(['status' => 'read']);
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * UPDATE STATUS (read/replied/archived)
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied,archived',
        ]);

        $contactMessage->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Message status updated successfully');
    }

    /**
     * DELETE MESSAGE
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully');
    }
}