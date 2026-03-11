<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client_name');
            $table->string('category'); // Client Web App, SaaS Product, Freelance Case Study, Tool Demo
            $table->string('emoji', 10)->default('🚀');
            $table->string('accent_color', 20)->default('#a855f7'); // per-card color
            $table->string('tagline', 200); // short one-liner under title
            $table->text('overview');       // the problem / background
            $table->text('challenge');      // what made it hard
            $table->text('solution');       // what was built / approach
            $table->text('results');        // outcomes — stored as JSON array of {metric, label}
            $table->text('tech_stack');     // JSON array of strings
            $table->integer('duration_weeks')->nullable();
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};
