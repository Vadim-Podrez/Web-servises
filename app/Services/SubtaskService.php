<?php

namespace App\Services;

use App\Models\Subtask;
use Illuminate\Database\Eloquent\Collection;

class SubtaskService
{
    public function getAll(): Collection
    {
        return Subtask::with('task')
            ->latest()
            ->get();
    }

    public function create(array $data): Subtask
    {
        return Subtask::create($data);
    }

    public function find(int $id): ?Subtask
    {
        return Subtask::with('task')->find($id);
    }

    public function update(Subtask $subtask, array $data): Subtask
    {
        $subtask->update($data);
        $subtask->load('task');

        return $subtask;
    }

    public function delete(Subtask $subtask): void
    {
        $subtask->delete();
    }
}