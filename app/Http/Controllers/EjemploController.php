<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateRequest;
use App\Http\Requests\ShowDestroyRequest;
use App\Models\Ejemplo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EjemploController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Ejemplo.index');
    }
    
    public function fetch()
    {
        $ejemplos = Ejemplo::all();
        return response()->json($ejemplos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateRequest $request)
    {
        $ejemplo = new Ejemplo;
        $ejemplo->Nombre = $request->Nombre;
        $ejemplo->Descripcion = $request->Descripcion;
        //$ejemplo = Ejemplo::create($data);
        DB::update('EXEC SP_DS_Insert_Ejemplos ?,?',
                                [$ejemplo->Nombre, $ejemplo->Descripcion]);
                                
        return response()->json([
            "status" => 200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(ShowDestroyRequest $request)
    {
        $id = $request->Id_Ejemplo;
        $ejemplo = Ejemplo::where('Id_Ejemplo', $id)->first();
        return response()->json($ejemplo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateRequest $request)
    {        
        $ejemplo = new Ejemplo;
        $ejemplo->Id_Ejemplo = $request->Id_Ejemplo;
        $ejemplo->Nombre = $request->Nombre;
        $ejemplo->Descripcion = $request->Descripcion;
        DB::update('EXEC SP_DS_Actualizar_Ejemplos ?,?,?', 
                    [$ejemplo->Id_Ejemplo, $ejemplo->Nombre, $ejemplo->Descripcion]);
        return response()->json([
            "status" => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShowDestroyRequest $request)
    {
        $tamano = count($request->Id_Ejemplo);

        for($x = 0; $x < $tamano; $x++){
            DB::update('EXEC SP_Ejemplos_Eliminar ?', [$request->Id_Ejemplo[$x]]);
        }

        return response()->json([
            "status" => 200
        ]);
    }
}
