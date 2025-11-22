<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("store_id")->constrained("stores");
            $table->foreignId("brand_id")->constrained("brands");
            $table->enum('product_type', ["physical", "digital"]);
            $table->string("name");
            $table->string("slug");
            $table->decimal("price", 15, 2);
            $table->longText("description");
            $table->text("short_description")->nullable();
            $table->decimal("special_price", 15, 2)->nullable();
            $table->date("special_price_start")->nullable();
            $table->date("special_price_end")->nullable();
            $table->string("sku")->nullable();
            $table->boolean("manage_stock")->default(true);
            $table->integer("qty")->default(0);
            $table->boolean("in_stock")->default(false);
            $table->integer("viewed")->default(0);
            $table->enum("status", ["active", "inactive", "draft"])->default("draft");
            $table->enum("approved_status", ["approved", "pending", "rejected"])->default("pending");
            $table->boolean("is_featured")->default(false);
            $table->boolean("is_hot")->default(false);
            $table->boolean("is_new")->default(false);
            $table->softDeletesDatetime();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
