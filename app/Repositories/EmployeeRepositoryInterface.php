<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Http\Request;

interface EmployeeRepositoryInterface {

    public function getEmployees(Request $request);

    public function getEmployeeById(int $id);

    public function createEmployee(Request $request);

    public function updateEmployee(Request $request, Employee $employee);

    public function deleteEmployee(Employee $employee);

}