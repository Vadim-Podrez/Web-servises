<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function getAll(): Collection
    {
        return Task::with('subtasks')
            ->latest()
            ->get();
    }

    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function find(int $id): ?Task
    {
        return Task::with('subtasks')->find($id);
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);
        $task->load('subtasks');

        return $task;
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}