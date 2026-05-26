<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('volunteer_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('event_id')->constrained();
            $table->string('task');
            $table->string('status')->default('pending'); // pending, accepted, declined
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('volunteer_assignments');
    }
};