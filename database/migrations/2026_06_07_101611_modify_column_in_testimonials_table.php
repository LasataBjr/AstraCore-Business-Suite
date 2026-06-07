<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Convert existing boolean data so the database engine doesn't break
        // Match '1' (true) to 'approved' and '0' (false) to 'pending'
        DB::table('testimonials')->where('status', '1')->update(['status' => 'approved']);
        DB::table('testimonials')->where('status', '0')->update(['status' => 'pending']);

        //  change the column structure to enum
        Schema::table('testimonials', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // Revert back to boolean if you ever rollback
            $table->boolean('status')
                  ->default(true)
                  ->change();
        });
    }
};