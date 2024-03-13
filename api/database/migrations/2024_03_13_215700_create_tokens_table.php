<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->string('user_id');
            $table->integer('last_used');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
