<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function grades()
    {
        try{

            $grades = Grade::all();

            if($grades){
                return response()->json(['grades' => $grades]);
            } else {
                return response()->json(['message' => 'No hay grados registrados!']);
            }

        } catch(Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function create(Request $req)
    {
        try{

            $req->validate([
                'grade' => 'required | min:1 | max:2 | unique:grades'
            ]); 

            $grade = Grade::create($req->all());

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
                'grade' => 'required | min:1 | max:2 | unique:grades'
            ]);

            $grade->update($req->all());

            return response()->json([
                'message' => 'Grado actualizado correctamente',
                $grade,
            ]);

        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage(), 500]);
        }
    }

    public function delete(Grade $grade)
    {
        try {
            if($grade){
                $grade->delete();
    
                return response()->json([
                    'message' => 'Grado eliminado correctamente',
                    $grade,
                ]);
            } 
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage(), 500]);
        }
    }
}
