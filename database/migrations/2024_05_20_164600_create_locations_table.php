<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\User::class, "user_id")
                ->constrained()
                ->cascadeOnDelete();

            $table->string("name");
            $table->float("long");
            $table->float("lat");
            $table->timestamps();

            $table->unique(["user_id", "name"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
