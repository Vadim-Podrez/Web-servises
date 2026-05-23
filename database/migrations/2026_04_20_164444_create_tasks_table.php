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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // створює первинний ключ;
            $table->string('title'); // зберігає короткий заголовок;
            $table->text('description')->nullable(); // дозволяє зберігати розширений опис, який може бути відсутнім;
            $table->string('status')->default('pending'); // встановлює початковий статус;
            $table->date('due_date')->nullable(); // дозволяє зберігати дедлайн;
            $table->timestamps(); // автоматично додає поля created_at і updated_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
