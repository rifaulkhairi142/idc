<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'username', 'created_by');
    }

    public function kelas()
    {
        return $this->hasOne(LamaranKPM::class, 'id', 'id_kelas');
    }

    public function tugas()
    {
        return $this->hasOne(Task::class, 'id', 'id_tugas');
    }

    protected $table = 'comment';
}
