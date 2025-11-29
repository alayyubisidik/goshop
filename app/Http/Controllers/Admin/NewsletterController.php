<?php

namespace App\Http\Controllers\Admin;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Services\MailService;
use App\Http\Controllers\Controller;
use App\Services\AlertService;

class NewsletterController extends Controller
{
    function index()
    {
        $newsletters = Newsletter::paginate(20);
        return view("admin.dashboard.newsletter.index", compact("newsletters"));
    }

    function store(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        Newsletter::where('is_verified', 1)
            ->chunk(100, function ($chunk) use ($request) {
                foreach ($chunk as $subscriber) {
                    MailService::sendAndQueue(
                        $subscriber->email,
                        $request->subject,
                        $request->message
                    );
                }
            });

        AlertService::created('Newsletter sent successfully');
        return redirect()->back();
    }


    public function changeVerified(int $newsletterId)
    {
        $newsletter = Newsletter::findOrFail($newsletterId);

        // toggle nilainya
        $newsletter->is_verified = $newsletter->is_verified == 1 ? 0 : 1;

        $newsletter->save();

        AlertService::updated();

        return back();
    }
}
