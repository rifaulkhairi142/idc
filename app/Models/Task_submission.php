<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task_submission extends Model
{
    use HasFactory;

    public function mahasiswa()
    {
        return $this->hasOne(User::class, 'username', 'username_mahasiswa');
    }

    public function kelas()
    {
        return $this->hasOne(LamaranKPM::class, 'id', 'id_kelas');
    }

    public function tugas()
    {
        return $this->hasOne(Task::class, 'id', 'id_tugas');
    }

    protected $table = 'task_submission';
}
