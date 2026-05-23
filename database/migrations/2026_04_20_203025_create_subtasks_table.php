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
        Schema::create('subtasks', function (Blueprint $table) {
            $table->id();

            // Створюємо зв'язок з таблицею tasks.
            // cascade означає: якщо видалити основну задачу, всі її підзадачі теж видаляться.
            $table->foreignId('task_id')->constrained()->onDelete('cascade');

            $table->string('title');
            $table->boolean('is_completed')->default(false); // За замовчуванням підзадача не виконана

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtasks');
    }
};
