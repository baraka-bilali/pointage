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
        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('agent_id')->constrained()->onDelete('cascade')->after('id');
            $table->date('date')->after('agent_id');
            $table->timestamp('time_in')->nullable()->after('date');
            $table->timestamp('time_out')->nullable()->after('time_in');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn(['agent_id', 'date', 'time_in','time_out']);
        });
    }
};
