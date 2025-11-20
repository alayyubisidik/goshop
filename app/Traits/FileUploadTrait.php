<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait FileUploadTrait {

    public function uploadFile(UploadedFile $file, ?string $oldPath = null, string $path) : ?string
    {
        if (!$file) {
            return null;
        }

        // File default yg tidak boleh dihapus
        $ignorePath = [
            "/img/defaults/avatar.png",
            "/img/defaults/logo.png",
            "/img/defaults/banner.png",
            "/img/defaults/brand.png",
        ];

        // hapus file lama kecuali default
        if ($oldPath && File::exists(public_path($oldPath)) && !in_array($oldPath, $ignorePath)) {
            File::delete(public_path($oldPath));
        }

        $folderPath = public_path("img/" . $path);

        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0777, true);
        }

        $filename = Str::uuid() . "." . $file->getClientOriginalExtension();

        $file->move($folderPath, $filename);

        return "img/" . $path . "/" . $filename;
    }

    public function uploadPrivateFile(UploadedFile $file, ?string $oldPath = null, ?string $path = "img") : ?string
    {
        if (!$file->isValid()) {
            return null;
        }

        $filename = Str::uuid() . "." . $file->getClientOriginalExtension();
        $path = $file->storeAs($path, $filename, 'local');

        return $path;
    }

    public function deleteFile(string $path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
            return true;
        }

        return false;
    }
}
