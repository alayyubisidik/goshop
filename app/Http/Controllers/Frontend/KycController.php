<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class KycController extends Controller
{
    use FileUploadTrait;

    function index()
    {
        if (user()->kyc?->status == "approved" || user()->kyc?->status == "pending") {
            return redirect()->route("vendor.dashboard.index");
        }

        return view('frontend.pages.kyc-verification');
    }

    function store(Request $request)
    {
        $request->validate([
            "full_name" => ["required", "min:2", "max:255", "string"],
            "date_of_birth" => ["required", "date"],
            "gender" => ["required", "in:female,male"],
            "full_address" => ["required", "max:255", "string"],
            "document_type" => ["required", "max:255", "string"],
            "document_scan_copy" => [
                "required",
                "file",
                "image",          // hanya menerima image
                "mimes:jpeg,jpg,png", // batasi tipe image
                "max:5000",       // maksimal 2MB, bisa diubah
            ],
        ]);

        $user = user();
        $user->user_type = "vendor";

        if (Kyc::where("user_id", $user->id)->exists()) {
            $kyc = Kyc::where("user_id", $user->id)->first();
            $kyc->status = "pending";
        } else {
            $kyc = new Kyc();
        }

        $kyc->full_name = $request->full_name;
        $kyc->user_id = $user->id;
        $kyc->date_of_birth = $request->date_of_birth;
        $kyc->gender = $request->gender;
        $kyc->full_address = $request->full_address;
        $kyc->document_type = $request->document_type;
        $filePath = $this->uploadPrivateFile($request->file("document_scan_copy"));
        $kyc->document_scan_copy = $filePath;

        $kyc->save();
        $user->save();

        AlertService::created("Your KYC has been submitted, Please wait for admin approval");

        return redirect()->route("vendor.dashboard.index");
    }
}
