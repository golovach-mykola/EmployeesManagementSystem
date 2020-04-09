<?php


namespace App\Repositories\Users;


use App\User;
use Illuminate\Database\Eloquent\Builder;

class ManagerRepository
{

    /**
     * Get all managers
     *
     * @return mixed
     */
    public function all()
    {
        return User::whereHas('role', function (Builder $query) {
            $query->whereSlug(User::USER_ROLE_MANAGER);
        })->orderBy('name')->get();
    }

    public function getEmployees(User $manager)
    {
        return $manager->employees()->paginate(config('app.items_on_page'));
    }
}
