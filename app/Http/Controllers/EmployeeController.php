<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeIndexRequest;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;

class EmployeeController extends Controller
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function index(EmployeeIndexRequest $request) {
        $data = $this->employeeRepository->getEmployees($request);

        return response()->json($data);
    }

    public function show(Employee $employee) {
        $data = $this->employeeRepository->getEmployeeById($employee->id);

        return response()->json($data);
    }

    public function store(EmployeeStoreRequest $request) {
        $this->employeeRepository->createEmployee($request);

        return response()->json([], 201);
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee) {
        $this->employeeRepository->updateEmployee($request, $employee);

        return response()->json([], 200);
    }

    public function destroy(Employee $employee) {
        $this->employeeRepository->deleteEmployee($employee);

        return response()->json([], 200);
    }
}
