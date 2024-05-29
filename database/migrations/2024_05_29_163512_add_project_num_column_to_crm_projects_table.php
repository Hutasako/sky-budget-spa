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
        Schema::table('crm_projects', function (Blueprint $table) {
            $table->string('project_number')->nullable()->after('user_rep_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crm_projects', function (Blueprint $table) {
            $table->dropColumn('project_number');
        });
    }
};
