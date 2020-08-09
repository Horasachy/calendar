<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
use App\Models\Company;
use seeds\Traits\CompanySeederTrait;
use seeds\Traits\EventsSeederTrait;
use seeds\Traits\CompanyEventsSeederTrait;

class DatabaseSeeder extends Seeder
{
    use CompanySeederTrait;
    use EventsSeederTrait;
    use CompanyEventsSeederTrait;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MonthsSeeder::class);
        $this->runCreateCompanies();
        $this->runCreateUsers();
        $this->createCompanyEvents();
    }

    public function runCreateUsers()
    {
        echo "Create users\n";
        $users = factory(User::class, 50)->create();

        foreach ($users as $user) {
            $this->createCompanyUsers($user);
            $this->createEvents($user);
        }


        echo "Users: " . count($users) . "\n";
    }

    public function runCreateCompanies()
    {
        echo "Create companies\n";
        factory(Company::class, 20)->create();
    }
}
