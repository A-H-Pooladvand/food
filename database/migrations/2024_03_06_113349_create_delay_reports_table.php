<?php

use App\Models\Order;
use App\Models\Agent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delay_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnUpdate()->cascadeOnUpdate();
            $table->foreignIdFor(Agent::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnUpdate();
            $table->timestamp('followed_up_at')->nullable()->comment('زمان پایان پیگیری');
            $table->enum('status', ['IN_PROGRESS', 'DONE'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delay_reports');
    }
};
