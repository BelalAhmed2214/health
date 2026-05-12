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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('national_id', 14)->unique();

            $table->string('mobile', 11)->unique()->nullable();

            $table->date('date_of_birth')->nullable();

            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();

            $table->integer('children_count')->nullable();

            $table->string('governorate')->nullable();

            $table->text('address')->nullable();
            $table->text('problem')->nullable();
            $table->text('solution')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('visit_date')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->decimal('price', 10, 2)->nullable();
            $table->string('follower')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
