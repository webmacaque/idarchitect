<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('panoramas', function (Blueprint $table) {
            $table->string('public_hash', 16)->nullable()->after('type');
        });

        DB::table('panoramas')
            ->orderBy('id')
            ->chunkById(100, function ($rows) {
                foreach ($rows as $row) {
                    do {
                        $hash = Str::random(16);
                    } while (DB::table('panoramas')->where('public_hash', $hash)->exists());

                    DB::table('panoramas')
                        ->where('id', $row->id)
                        ->update(['public_hash' => $hash]);
                }
            });

        Schema::table('panoramas', function (Blueprint $table) {
            $table->unique('public_hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('panoramas', function (Blueprint $table) {
            $table->dropUnique(['public_hash']);
            $table->dropColumn('public_hash');
        });
    }
};
