<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tortas', function (Blueprint $table) {
            // default(0): las tortas anteriores quedan con stock 0
            $table->unsignedInteger('stock')->default(0)->after('precio');
        });
    }

    public function down(): void
    {
        Schema::table('tortas', function (Blueprint $table) {
            $table->dropColumn('stock');
        });
    }
};
