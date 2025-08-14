<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminEmployeeController extends Controller
{
    private static $validationRules = [
        'name' => 'required|string|max:128',
        'position' => 'required|string|max:128',
        'photo' => 'image|max:2048',
    ];

    public function index()
    {
        $employees = Employee::orderBy('sorting_order', 'asc')->get();
        return view('admin.employees', compact('employees'));
    }

    public function create()
    {
        return view('admin.employee-create');
    }

    public function store(Request $request)
    {
        $request->validate(self::$validationRules);

        $photoBase64 = null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $photoBase64 = base64_encode(file_get_contents($image));
        }

        Employee::create([
            'name' => $request->name,
            'position' => $request->position,
            'photo_path' => $photoBase64,
            'sorting_order' => Employee::max('sorting_order') + 1,
        ]);

        return redirect()->route('admin-employees');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employee-edit', compact('employee'));
    }

    public function update(Request $request, int $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate(self::$validationRules);

        $photoBase64 = $employee->photo_path;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $photoBase64 = base64_encode(file_get_contents($image));
        } elseif ($request->input('keep_existing_photo') === '0') {
            $photoBase64 = null;
        }

        $employee->update([
            'name' => $request->name,
            'position' => $request->position,
            'photo_path' => $photoBase64,
        ]);

        return redirect()->route('admin-employees');
    }

    public function destroy(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
        $employee->delete();
        return redirect()->route('admin-employees');
    }

    public function reorder(Request $request, int $id)
    {
        $employee = Employee::findOrFail($id);
        $direction = $request->input('direction');
        $currentOrder = $employee->sorting_order;

        if ($direction === 'up' && $currentOrder > 0) {
            $prevEmployee = Employee::where('sorting_order', '<', $currentOrder)
                ->orderBy('sorting_order', 'desc')
                ->first();

            if ($prevEmployee) {
                $employee->update(['sorting_order' => $prevEmployee->sorting_order]);
                $prevEmployee->update(['sorting_order' => $currentOrder]);
                $employee->save();
                $prevEmployee->save();
            }
        } elseif ($direction === 'down') {
            $nextEmployee = Employee::where('sorting_order', '>', $currentOrder)
                ->orderBy('sorting_order', 'asc')
                ->first();
            if ($nextEmployee) {
                $employee->update(['sorting_order' => $nextEmployee->sorting_order]);
                $nextEmployee->update(['sorting_order' => $currentOrder]);
                $employee->save();
                $nextEmployee->save();
            }
        }

        return redirect()->route('admin-employees');
    }
}
