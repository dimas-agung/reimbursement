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
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('nomor');
            $table->string('doc_no');
            $table->string('name');
            $table->text('description');
            $table->string('attachment')->nullable();
            $table->unsignedBigInteger('user_action')->nullable();
            $table->foreign('user_action')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_created');
            $table->integer('status')->default(0);
            $table->foreign('user_created')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reimbursements');
    }
};