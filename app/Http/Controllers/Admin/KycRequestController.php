<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Services\AlertService;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class KycRequestController extends Controller implements HasMiddleware
{
    static function Middleware(): array
    {
        return [
            new Middleware("permission:Manage KYC|View KYC")
        ];
    }

    public function index()
    {
        $kycRequests = Kyc::paginate(25);
        return view("admin.dashboard.kyc.index", compact("kycRequests"));
    }

    public function pending()
    {
        $kycRequests = Kyc::where("status", "pending")->paginate(25);
        return view("admin.dashboard.kyc.pending", compact("kycRequests"));
    }

    public function rejected()
    {
        $kycRequests = Kyc::where("status", "rejected")->paginate(25);
        return view("admin.dashboard.kyc.rejected", compact("kycRequests"));
    }

    public function show(Kyc $kyc_request)
    {
        return view("admin.dashboard.kyc.show", compact('kyc_request'));
    }

    public function download(Kyc $kyc_request)
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('local');
        return $disk->download($kyc_request->document_scan_copy);
    }

    public function update(Kyc $kyc_request, Request $request) {
        $kyc_request->update([
            "status" => $request->status
        ]);

        if ($kyc_request->status == "approved") {
            MailService::send(
                to: $kyc_request->user->email,
                subject: "KYC Application Has Been Approved",
                body: "Congratulation! Your KYC Application Has Been Approved"
            );
        } else if ($kyc_request->status == "rejected") {
            MailService::send(
                to: $kyc_request->user->email,
                subject: "KYC Application Has Been Rejected",
                body: "Sorry! Your KYC Application Has Been Rejected"
            );
        }

        AlertService::updated();

        return redirect()->route("admin.dashboard.kyc.index");
    }
}
