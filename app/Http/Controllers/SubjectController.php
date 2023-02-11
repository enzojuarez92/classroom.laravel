<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function show(Subject $subject)
    {
        try{
            $subject = Subject::find($subject);

            return response()->json($subject);

        } catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }
    public function subjects()
    {
        try{
            $subjects = Subject::all();

            return response()->json($subjects);

        } catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function create(Request $req)
    {
        try{

            $req->validate([
                'subject' => 'required | min:3 | max:20 | unique:subjects,subject'
            ]); 

            $subject = Subject::create($req->all());

            return response()->json([
                'message' => 'Materia creada correctamente',
                $subject
            ]);

        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(Request $req, Subject $subject)
    {        
        try {
            $req->validate([
                'subject' => 'required | min:3 | max:20 | unique:subjects,subject'
            ]);

            $subject->update($req->all());

            return response()->json([
                'message' => 'Materia actualizada correctamente',
                $subject,
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function delete(Subject $subject)
    {
        try {
            $subject->delete();

            return response()->json([
                'message' => 'Materia eliminada correctamente',
                $subject,
            ]);            
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
