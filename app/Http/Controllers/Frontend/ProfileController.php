<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

use function Flasher\Notyf\Prime\notyf;

class ProfileController extends Controller
{
    use FileUploadTrait;
    public function index()
    {
        return view("frontend.dashboard.profile.index");
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            "name" => ["required", "string", "max:100"],
            "email" => ["required", "email", "unique:users,email," . auth("web")->user()->id],
            "avatar" => ["nullable", "image", "max:2048"]
        ]);


        /** @var \App\Models\User $user */
        $user = auth("web")->user();
        if ($request->hasFile("avatar")) {
            $filepath = $this->uploadFile($request->file("avatar"), $user->avatar, "avatar");
            $filepath ? $user->avatar = $filepath : null;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        AlertService::updated("Profile Updated Successfully");

        return redirect()->back();
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            "current_password" => ["required", "string", "current_password"],
            "password" => ["required", "string", "min:3", "max:255", "confirmed"]
        ]);

        /** @var \App\Models\User $user */
        $user = auth("web")->user();
        $user->password = bcrypt($request->password);
        $user->save();

        AlertService::updated("Password Updated Successfully");

        return redirect()->back();
    }
}
