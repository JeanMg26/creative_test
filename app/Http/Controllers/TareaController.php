<?php

namespace App\Http\Controllers;

use App\Tarea;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TareaController extends Controller
{
    public function datatables()
    {
        $tarea = DB::table('tareas')
            ->select('tareas.id as tarea_id', 'tareas.descripcion as des_tarea', 'tareas.estado as est_tarea');

        return DataTables::of($tarea)
            ->addColumn('acciones', function ($tarea) {
                return
                    '<div class="text-center">
                        <button class="btn btn-info mr-1 btn-sm editarTareaBtn"  id="' . $tarea->tarea_id . '">
                      Editar
                    </button>
                    <button class="btn btn-danger mr-1 btn-sm eliminarTareaBtn" id="' . $tarea->tarea_id . '">
                      Eliminar
                    </button>';
            })->addIndexColumn()
            ->rawColumns(['acciones'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::all();
        return view("tareas.index", compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'des_tarea' => 'required|max:100'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()]);
        }

        $tarea = new Tarea;
        $tarea->descripcion = $request->des_tarea;
        $tarea->estado = rand(0, 1);
        $tarea->save();

        return response()->json(['success' => 'Registro agregado correctamente.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function edit($tarea_id)
    {
        if (request()->ajax()) {
            $tarea = Tarea::findOrFail($tarea_id);
            return response()->json(['tarea' => $tarea]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        $rules = [
            'des_tarea' => 'required|max:100'
        ];

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()]);
        }

        $tarea = Tarea::findOrFail($request->tarea_id);
        $tarea->descripcion = $request->des_tarea;
        $tarea->estado = $tarea->estado;
        $tarea->save();

        return response()->json(['success' => 'Registro actualizado correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function destroy($eliminar_id)
    {
        $tarea = Tarea::find($eliminar_id);
        $tarea->delete();
    }

    public function obtenerTareas()
    {
        $tareas = Tarea::get();
        // $tareas = Tarea::offset(0)->limit(4)->get();
        return response()->json(['tareas' => $tareas]);
    }

    public function pagination()
    {
        $tareas = Tarea::count();
        $paginacion = intdiv($tareas, 5);
        return response()->json(['paginacion' => $paginacion]);
    }
}
