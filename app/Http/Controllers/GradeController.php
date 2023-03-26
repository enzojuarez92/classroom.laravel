<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function show(Grade $grade)
    {
        try{
            $grade = Grade::find($grade);

            return response()->json($grade);

        } catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }
    public function grades()
    {
        try{
            $grades = Grade::all();

            return response()->json($grades);

        } catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function create(Request $req)
    {
        try{

            $req->validate([
                'grade' => 'required | min:1 | max:2 | unique:grades,grade'
            ]); 
            
            $section = Section::find($req->section);

            $grade = Grade::create([
                'grade' => $req->grade
            ]);

            $grade->sections()->attach($section);

            return response()->json([
                'message' => 'grado creado correctamente',
                $grade
            ]);

        } catch(Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $req, Grade $grade)
    {        
        try {
            $req->validate([
                'grade' => 'required | min:1 | max:2 | unique:grades,grade'
            ]);

            $grade->update($req->all());

            return response()->json([
                'message' => 'Grado actualizado correctamente',
                $grade,
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function delete(Grade $grade)
    {
        try {
            $grade->delete();

            return response()->json([
                'message' => 'Grado eliminado correctamente',
                $grade,
            ]);            
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage(), 500]);
        }
    }
}