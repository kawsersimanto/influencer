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
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        // Insert default platform names
        DB::table('platforms')->insert([
            [
                'name' => 'Any',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Instagram',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'TikTok',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Generate Content',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Youtube',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};
