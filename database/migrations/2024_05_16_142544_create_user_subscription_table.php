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
        Schema::create('user_subscription', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\User::class, "user_id")
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(\App\Models\Subscription::class, "subscription_id")
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(\App\Models\Payment::class, "payment_id")
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->dateTime("valid_from")
                ->useCurrent();

            $table->dateTime("valid_until")
                ->nullable();

            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subscription');
    }
};
