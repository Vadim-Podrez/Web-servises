<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubtaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');

        return [
            'task_id' => [$isUpdate ? 'sometimes' : 'required', 'integer', 'exists:tasks,id'],
            'title' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:255'],
            'is_completed' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'task_id.required' => 'Необхідно вказати основне завдання',
            'task_id.exists' => 'Основне завдання з таким ідентифікатором не знайдено',
            'title.required' => 'Назва підзавдання є обов’язковою',
            'title.max' => 'Назва підзавдання не повинна перевищувати 255 символів',
            'is_completed.boolean' => 'Поле виконання має бути логічним значенням',
        ];
    }
}
