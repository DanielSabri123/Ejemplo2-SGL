<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejemplo;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Http\Requests\Ejemplo\StoreRequest;
use App\Http\Requests\Ejemplo\UpdateRequest;
use App\Http\Requests\Ejemplo\ShowRequest;
use App\Http\Requests\Ejemplo\DestroyRequest;
use Illuminate\Support\Facades\Log;

use Exception;

class Ejemplo2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Ejemplo2.Index');
    }

    public function fetch()
    {
        try {
            $data = DB::select('SP_DS_Select_Ejemplos');
            
            return DataTables::of($data)->toJson();
        } catch (\Throwable $e) {
            // Capturar el error y tomar acciones adecuadas, como registrar el error, devolver un mensaje de error, etc.
            // Log::error('Error al retornar la tabla: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al retornar la tabla.'.$e->getMessage()], 500);
        }
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $objeto = $request->input('Datos');
            $ejemplo = new Ejemplo;
            $ejemplo->Nombre = $objeto['nombre'];
            $ejemplo->Descripcion = $objeto['descripcion'];
            DB::update(
                'EXEC SP_DS_Insert_Ejemplos ?,?',
                [$ejemplo->Nombre, $ejemplo->Descripcion]
            );
            return response()->json(['status' => 'success', 'titulo' => 'Registro exitoso', 'mensaje' => 'Se registro el ejemplo exitosamente']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'titulo' => 'Error al realizar el registro', 'mensaje' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowRequest $request)
    {
        try {
            $objeto = $request->input('Datos');
            $id = $objeto['Id_Ejemplo'];    
            $ejemplo = Ejemplo::where('Id_Ejemplo', $id)->first();
            return response()->json($ejemplo); 
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'titulo' => 'Error al consultar el dato', 'mensaje' => $e->getMessage()]);
        }
         
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        try{
            $objeto = $request->input('Datos');
            $ejemplo = new Ejemplo;
            $ejemplo->Id_Ejemplo = $objeto['idEjemplo'];
            $ejemplo->Nombre = $objeto['nombre'];
            $ejemplo->Descripcion = $objeto['descripcion'];
            DB::update('EXEC SP_DS_Actualizar_Ejemplos ?,?,?', 
                        [$ejemplo->Id_Ejemplo, $ejemplo->Nombre, $ejemplo->Descripcion]);
            return response()->json(['status' => 'success', 'titulo' => 'Modificacion exitoso', 'mensaje' => 'Se modifico el ejemplo exitosamente']);
        }catch (Exception $e) {
            return response()->json(['status' => 'error', 'titulo' => 'Error al modificar', 'mensaje' => $e->getMessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request)
    {
        try{
            $objeto = $request->input('Datos');
                     
            $tamano = count($objeto);

            for($x = 0; $x < $tamano; $x++){
                DB::update('EXEC SP_Ejemplos_Eliminar ?', [$objeto[$x]]);
            }

            return response()->json(['status' => 'success', 'titulo' => 'Eliminacion exitosa', 'mensaje' => 'Se elimino exitosamente']);
        }catch(Exception $e){
            return response()->json(['status' => 'error', 'titulo' => 'Error al eliminar', 'mensaje' => $e->getMessage()]);
        }
    }
}
