<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function store(Request $req)
    {
        $req->validate([
            'file' => ['required', 'file', 'mimes:png,jpg,pdf,docx'],
            'subject_id' => ['required', 'exists:subjects,id']
        ]);

        $filename = $req->file('file')->getClientOriginalName();
        $type = $req->file('file')->getClientOriginalExtension();
        $user = Auth::user();
        $url = $req->file('file')->storeAs("local/{$user->id}", $filename);
        $subject = $req->subject_id;

        $user->files()->create([
            'filename' => $filename,
            'url' => $url,
            'type' => $type,
            'subject_id' => $subject,
        ]);

        return response(['message' => 'El archivo ha sido subido exitosamente']);
    }

    public function download($file)
    {
        
    }
}
