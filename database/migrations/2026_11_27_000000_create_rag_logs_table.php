<?php

declare(strict_types=1);

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
        Schema::create('rag_logs', function (Blueprint $table) {
            $table->id();
            $table->string('session_hash', 64)->index();
            $table->text('question');
            $table->longText('answer')->nullable();
            $table->unsignedInteger('chunks_count')->default(0);
            $table->float('top_score')->nullable();
            $table->json('sources')->nullable();
            $table->boolean('cache_hit')->default(false)->index();
            $table->string('blocked_reason', 64)->nullable()->index();
            $table->unsignedInteger('latency_ms')->default(0);
            $table->string('status', 32)->default('completed')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rag_logs');
    }
};
