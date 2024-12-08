<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function index(Request $request) {
        $data = $this->employee->getEmployees($request);

        return response()->json($data);
    }

    public function show(Employee $employee) {
        return response()->json($employee);
    }

    public function search(Request $request) {
        $q = $request->string('q');

        $data = Employee::where('first_name', 'like', "%$q%")
                    ->orWhere('last_name', 'like', "%$q%");
        $data = $data->paginate();

        return response()->json($data);
    }

    public function store(EmployeeStoreRequest $request) {
        $validated = $request->validated();

        Employee::create($validated);

        return response()->json([], 201);
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee) {
        $validated = $request->validated();

        $employee->update($validated);

        return response()->json([], 200);
    }

    public function destroy(Employee $employee) {
        $employee->delete();

        return response()->json([], 200);
    }
}
