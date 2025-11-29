<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\AlertService;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    function index()
    {
        $messages = Contact::latest()->paginate(30);
        return view('admin.dashboard.contact-message.index', compact('messages'));
    }

    function destroy(Contact $message)
    {
        $message->delete();

        AlertService::deleted();

        return back();
    }
}
