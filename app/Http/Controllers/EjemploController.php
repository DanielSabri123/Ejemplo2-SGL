<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateRequest;
use App\Http\Requests\ShowDestroyRequest;
use App\Models\Ejemplo;
use Illuminate\Support\Facades\DB;

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
        $respuesta = "";
        if($ejemplos->count() >0){
            $respuesta .= "<table id='table-ejemplo' class='table table-hoverdisplay table-striped table-hover responsive no-wrap' width='100%'>
                                <thead class='bg-dark'>
                                    <tr>
                                        <td width='10%'>ID</td>
                                        <td width='30%'>Nombre</td>
                                        <td width='30%'>Descripcion</td>
                                        <td width='30%'>Acciones</td>
                                    </tr>
                                </thead>
                            <tbody>";
                            foreach($ejemplos as $e){
                                $respuesta .= "<tr>
                                    <td class='m-0 py-2'>$e->Id_Ejemplo</td>
                                    <td class='m-0 py-2'>$e->Nombre</td>
                                    <td class='m-0 py-2'>$e->Descripcion</td>
                                    <td class='m-0 py-0 text-center'>
                                        <a href='#' id=".$e->Id_Ejemplo." title='Detalles de ".$e->Nombre."' class='btn btn-warning text-white m-1 showIcon' data-toggle='modal' data-target='#modalVer'>Ver<a/>
                                        <a href='#' id=".$e->Id_Ejemplo." title='Modificar a ".$e->Nombre."' class='btn btn-success m-1 editIcon' data-toggle='modal' data-target='#modalEditar'>Editar<a/>
                                        <a href='#' id=".$e->Id_Ejemplo." title='Eliminar a ".$e->Nombre."' class='btn btn-danger m-1 deleteIcon'>Eliminar<a/>
                                    </td>
                                </tr>"; 
                            }
                        $respuesta.="<tbody>
                        </table>";
                        echo $respuesta;
                        
        }else{
            echo "<table id='table-ejemplo' class='table table-hoverdisplay table-striped table-hover responsive no-wrap' width='100%'>
            <thead class='bg-dark'>
                <tr>
                    <td width='10%'>ID</td>
                    <td width='30%'>Nombre</td>
                    <td width='30%'>Descripcion</td>
                    <td width='30%'>Acciones</td>
                </tr>
            </thead>
            <tbody class='py-5'>
            </tbody>";
        }
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
        DB::update('EXEC SP_DS_Delete_Ejemplo ?', [$request->Id_Ejemplo]);
        return response()->json([
            "status" => 200
        ]);
    }
}
