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
        Schema::create('crm_projects', function (Blueprint $table) {
            $table->id();
            $table->string('segment');
            $table->year('period_year');
            $table->string('customer_id');
            $table->string('customer_name');
            $table->unsignedBigInteger('user_rep_id');
            $table->string('project_name');
            $table->string('branch');
            $table->decimal('labor', 8, 2);
            $table->decimal('labor_margin', 8, 2);
            $table->decimal('sales', 8, 2);
            $table->decimal('sales_margin', 8, 2);
            $table->decimal('other', 8, 2);
            $table->decimal('other_margin', 8, 2);
            $table->decimal('gross_revenue', 8, 2);
            $table->decimal('expected_revenue', 8, 2);
            $table->decimal('net_revenue', 8, 2);
            // Define foreign key relations
            $table->foreign('user_rep_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_projects');
    }
};
