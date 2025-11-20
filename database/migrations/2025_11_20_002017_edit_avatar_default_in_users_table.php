<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ubah default kolom avatar
            $table->string('avatar')->default("/img/defaults/avatar.png")->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan default lama
            $table->string('avatar')->default("/defaults/avatar.png")->nullable()->change();
        });
    }
};
