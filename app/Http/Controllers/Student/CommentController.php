<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    // Public Comment: Create
    public function createPublicComment(Request $request)
    {
        try {
            
            $comment = Comment::create([
                'id_kelas' => $request->id_kelas,
                'id_tugas' => $request->id_tugas,
                'created_by' => $request->created_by,
                'tipe' => 'public',
            ]);
            return new CommentResource(true, 'Comment Public Berhasil dibuat!', $comment);

        } catch (\Exception $e) {
            return new CommentResource(false, $e->getMessage(), $e->getCode());
        }
    }

    // Public Comment: Query
    public function getPublicComments(Request $request)
    {
        try {

            $comments = Comment::where('tipe', 'public')
                ->when($request->id_kelas, fn($q) => $q->where('id_kelas', $request->id_kelas))
                ->when($request->id_tugas, fn($q) => $q->where('id_tugas', $request->id_tugas))
                ->get();
            return new CommentResource(true, 'List Comment!', $comments);

        } catch (\Exception $e) {
            return new CommentResource(false, $e->getMessage(), $e->getCode());
        }
    }

    // Private Comment: Create
    public function createPrivateComment(Request $request)
    {
        try {

            $comment = Comment::create([
                'id_kelas' => $request->id_kelas,
                'id_tugas' => $request->id_tugas,
                'created_by' => $request->created_by,
                'tipe' => 'private',
            ]);
            return new CommentResource(true, 'Comment Private Berhasil dibuat!', $comment);

        } catch (\Exception $e) {
            return new CommentResource(false, $e->getMessage(), $e->getCode());
        }
    }

    // Private Comment: Query
    public function getPrivateComments(Request $request)
    {
        try {

            $comments = Comment::where('tipe', 'private')
                ->when($request->id_kelas, fn($q) => $q->where('id_kelas', $request->id_kelas))
                ->when($request->id_tugas, fn($q) => $q->where('id_tugas', $request->id_tugas))
                ->when($request->created_by, fn($q) => $q->where('created_by', $request->created_by))
                ->get();
            return new CommentResource(true, 'List Comment!', $comments);

        } catch (\Exception $e) {
            return new CommentResource(false, $e->getMessage(), $e->getCode());
        }
    }

}
