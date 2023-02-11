<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Exception;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function show(Section $section)
    {
        try{
            $section = Section::find($section);

            return response()->json($section);

        } catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }
    public function sections()
    {
        try{
            $sections = Section::all();

            return response()->json($sections);

        } catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }

    public function create(Request $req)
    {
        try{

            $req->validate([
                'section' => 'required | min:1 | max:2 | unique:sections,section'
            ]); 

            $section = Section::create($req->all());

            return response()->json([
                'message' => 'Sección creada correctamente',
                $section
            ]);

        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(Request $req, Section $section)
    {        
        try {
            $req->validate([
                'section' => 'required | min:1 | max:2 | unique:sections,section'
            ]);

            $section->update($req->all());

            return response()->json([
                'message' => 'Sección actualizada correctamente',
                $section,
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function delete(Section $section)
    {
        try {
            $section->delete();

            return response()->json([
                'message' => 'Sección eliminada correctamente',
                $section,
            ]);            
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
