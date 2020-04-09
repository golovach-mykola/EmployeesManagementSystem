<?php

namespace App\Http\Controllers;

use App\Repositories\Users\ManagerRepository;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    /**
     * @var ManagerRepository
     */
    private $managerRepository;

    public function __construct(ManagerRepository $managerRepository)
    {

        $this->managerRepository = $managerRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->managerRepository->all();
        }

        return view('manager.list')->with([
            'managers' => $this->managerRepository->all()
        ]);
    }

    /**
     * @param Request $request
     * @param User $manager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Request $request, User $manager)
    {
        if ($request->wantsJson()) {
            return $this->managerRepository->getEmployees($manager);
        }
        return view('manager.show')->with([
            'manager' => $manager,
            'employees' => $this->managerRepository->getEmployees($manager)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->managerRepository->getEmployees(Auth::user());
        }
        return view('manager.show')->with([
            'manager' => Auth::user(),
            'employees' => $this->managerRepository->getEmployees(Auth::user())
        ]);
    }
}
