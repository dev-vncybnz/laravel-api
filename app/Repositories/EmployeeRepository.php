<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeRepository {

    private Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getEmployees(Request $request)
    {
        $validated = $request->validated();

        $perPage = $validated['per_page'];
        $keyword = isset($validated['keyword']) ? $validated['keyword'] : '';

        $query = $this->employee->search($keyword);

        return $query->paginate($perPage);
    }

    public function getEmployeeById($id) {
        $employee = Employee::findOrFail($id);

        return $employee;
    }

    public function createEmployee(Request $request) {
        $validated = $request->validated();

        Employee::create($validated);
    }

    public function updateEmployee(Request $request, Employee $employee) {
        $validated = $request->validated();

        $employee->update($validated);
    }

    public function deleteEmployee(Employee $employee) {
        $employee->delete();
    }

}