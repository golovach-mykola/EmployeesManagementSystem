<?php


namespace App\Repositories;


use App\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EmployeeRepository
{

    /**
     * Employee validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'phone' => ['required', 'string', 'max:12'],
        'address' => ['required', 'string', 'max:255'],
        'contract_date' => ['required', 'string', 'date_format:Y-m-d', 'max:255'],
        'contract_expiration_date' => ['required', 'string', 'date_format:Y-m-d', 'max:255'],
        'contract' => ['required_without:contract_old', 'file', 'mimes:pdf'],
        'user_id' => ['required', 'exists:App\User,id']
    ];

    /**
     * Get all employees
     *
     * @return mixed
     */
    public function all()
    {
        return Employee::orderBy('name')->paginate(config('app.items_on_page'));
    }

    /**
     * Create Employee
     *
     * @return Employee
     */
    public static function create()
    {
        request()->validate(self::$rules);
        $employee = Employee::create(request()->except('contract'));
        request()->session()->flash('status', __('Employee was created!'));
        return self::saveContract($employee);
    }

    /**
     * Update Employee
     *
     * @param Employee $employee
     * @return Employee
     */
    public static function update(Employee $employee)
    {
        request()->validate(self::$rules);
        $employee->update(request()->except('contract'));
        request()->session()->flash('status', __('Employee was updated!'));
        return self::saveContract($employee);
    }

    /**
     * Delete Employee
     *
     * @param Employee $employee
     * @throws \Exception
     */
    public static function delete(Employee $employee)
    {
        Storage::delete($employee->contract);
        $employee->delete();
        request()->session()->flash('status', __('Employee was deleted!'));
    }

    /**
     * Upload contract file
     *
     * @param Employee $employee
     * @return Employee
     */
    private static function saveContract(Employee $employee)
    {
        if (request()->hasFile('contract')) {
            $year = Carbon::now()->year;
            $employee->contract = request()->file('contract')->storeAs("public/contracts/{$employee->id}/{$year}",
                'contract.pdf');
            $employee->save();
        }
        return $employee;
    }
}
