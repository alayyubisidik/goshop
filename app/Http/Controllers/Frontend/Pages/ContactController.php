<?php

namespace App\Http\Controllers\Frontend\Pages;
use App\Http\Controllers\Controller;
use App\Mail\GenericMail;
use App\Models\Contact;
use App\Models\ContactSetting;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    function index()
    {
        $contactSetting = ContactSetting::first();
        return view("frontend.pages.contact", compact('contactSetting'));
    }

    function store(Request $request)
    {
        $validated =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:1000'],
        ]);
        // send mail to admin
        Mail::to(config('settings.site_email'))->send(new GenericMail($request->subject, $request->message, $request->email));

        Contact::create($validated);

        AlertService::created('Your message has been sent successfully. We will get back to you soon.');

        return redirect()->route('contact.index');
    }
}
