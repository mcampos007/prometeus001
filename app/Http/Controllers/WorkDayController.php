<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkDay;
use App\Models\User;

class WorkDayController extends Controller {
    //

    public function index()
    {

       // Recuperar los días de trabajo con la relación user
        $workDays = WorkDay::with('user')->get();

        return view('work_days.index', compact('workDays'));
    }

    public function create()
    {
         // Obtener usuarios con rol de 'profesor'
         $profesores = User::where( 'role', 'profesor' )->get();
        return view('work_days.create', compact('profesores'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'day' => 'required|string',
            'active' => 'required|boolean',
            'morning_start' => 'nullable|date_format:H:i',
            'morning_end' => 'nullable|date_format:H:i',
            'afternoon_start' => 'nullable|date_format:H:i',
            'afternoon_end' => 'nullable|date_format:H:i',
            'user_id' => 'required|exists:users,id',
        ]);

        WorkDay::create($validated);

        return redirect()->route('work_days.index')->with('success', 'Día de trabajo creado con éxito.');
    }

    public function edit($id)
{
    // Buscar el día de trabajo por su ID
    $workDay = WorkDay::findOrFail($id);
/*
    // Obtener la lista de profesores (usuarios con rol 'profesor')
    $profesores = User::whereHas('role', function ($query) {
        $query->where('name', 'profesor');
    })->get();
 */
    // Obtener usuarios con rol de 'profesor'
    $profesores = User::where( 'role', 'profesor' )->get();

    // Retornar la vista de edición con los datos del día de trabajo y los profesores
    return view('work_days.edit', compact('workDay', 'profesores'));
}

// En WorkDayController.php

public function update(Request $request, $id)
{
    //dd($request->all());
    $morning_start = substr($request->input('morning_start'), 0, 5); // '08:00'
    $morning_end = substr($request->input('morning_end'), 0, 5); // '12:00'
    $afternoon_start = substr($request->input('afternoon_start'), 0, 5); // '15:00'
    $afternoon_end = substr($request->input('afternoon_end'), 0, 5); // '20:00'

$request->merge([
    'morning_start' => $morning_start,
    'morning_end' => $morning_end,
    'afternoon_start' => $afternoon_start,
    'afternoon_end' => $afternoon_end,
]);
    // Validación de los datos enviados desde el formulario
    $request->validate([
        'day' => 'required|string',
        'active' => 'nullable|boolean',
        'morning_start' => 'nullable|date_format:H:i',
        'morning_end' => 'nullable|date_format:H:i|after:morning_start',
        'afternoon_start' => 'nullable|date_format:H:i',
        'afternoon_end' => 'nullable|date_format:H:i|after:afternoon_start',
        'user_id' => 'required|exists:users,id'
    ]);

    // Buscar el registro de WorkDay por su ID
    $workDay = WorkDay::findOrFail($id);

    // Actualizar el registro con los datos validados
    $workDay->update([
        'day' => $request->day,
        'active' => $request->has('active') ? 1 : 0, // Configurar como activo si se seleccionó
        'morning_start' => $request->morning_start,
        'morning_end' => $request->morning_end,
        'afternoon_start' => $request->afternoon_start,
        'afternoon_end' => $request->afternoon_end,
        'user_id' => $request->user_id
    ]);

    // Redirigir al índice de work_days con un mensaje de éxito
    return redirect()->route('work_days.index')->with('success', 'Día de trabajo actualizado correctamente.');
}

    // Métodos  , y destroy aquí

    public function destroy($id)
    {
        // Buscar el registro de WorkDay por su ID
        $workDay = WorkDay::findOrFail($id);

        // Eliminar el registro
        $workDay->delete();

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('work_days.index')->with('success', 'Día de trabajo eliminado correctamente.');
    }


}
