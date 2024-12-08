<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeIndexRequest;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Repositories\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface)
    {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function index(EmployeeIndexRequest $request) {
        $data = $this->employeeRepositoryInterface->getEmployees($request);

        return response()->json($data);
    }

    public function show(Employee $employee) {
        $data = $this->employeeRepositoryInterface->getEmployeeById($employee->id);

        return response()->json($data);
    }

    public function store(EmployeeStoreRequest $request) {
        $this->employeeRepositoryInterface->createEmployee($request);

        return response()->json([], 201);
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee) {
        $this->employeeRepositoryInterface->updateEmployee($request, $employee);

        return response()->json([], 200);
    }

    public function destroy(Employee $employee) {
        $this->employeeRepositoryInterface->deleteEmployee($employee);

        return response()->json([], 200);
    }
}
