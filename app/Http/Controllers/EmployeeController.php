<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Repositories\EmployeeRepository;
use App\Repositories\Users\ManagerRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {

        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('employee.list')->with([
            'employees' => $this->employeeRepository->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @var ManagerRepository
     * @return \Illuminate\Http\Response
     */
    public function create(ManagerRepository $managerRepository)
    {
        return view('employee.form')->with([
            'managers' => $managerRepository->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        EmployeeRepository::create();
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return redirect(Storage::url($employee->contract));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ManagerRepository $managerRepository
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(ManagerRepository $managerRepository, Employee $employee)
    {
        return view('employee.form')->with([
            'employee' => $employee,
            'managers' => $managerRepository->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Employee $employee)
    {
        EmployeeRepository::update($employee);
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Employee $employee)
    {
        EmployeeRepository::delete($employee);
        return redirect()->route('employees.index');
    }
}
