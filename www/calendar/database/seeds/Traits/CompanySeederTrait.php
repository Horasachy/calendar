<?php

namespace seeds\Traits;

use App\Models\Company;
use App\Models\CompanyUser;


/**
 * Trait CompanySeederTrait
 * @package seeds\Traits
 */
trait CompanySeederTrait
{

    /**
     * @param $users
     */
    private function createCompanyUsers($users)
    {
        echo "Create company users\n";
        factory(CompanyUser::class, 20)->make()
            ->each(function ($item) use ($users) {
                $item->employee_id = $users->id;
                $item->company_id = Company::without(['users', 'events'])->get()->random(1)->pluck('id')[0];
                $item->save();
            });
    }
}
