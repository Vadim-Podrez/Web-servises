<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');

        return [
            'title' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:pending,in_progress,completed'],
            'due_date' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Назва завдання є обов’язковою',
            'title.max' => 'Назва завдання не повинна перевищувати 255 символів',
            'status.in' => 'Статус має бути одним із значень: pending, in_progress, completed',
            'due_date.after_or_equal' => 'Дата виконання не може бути ранішою за сьогоднішню',
        ];
    }
}
