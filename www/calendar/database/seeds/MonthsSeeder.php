<?php

use Illuminate\Database\Seeder;

class MonthsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertData('January');
        $this->insertData('February');
        $this->insertData('March');
        $this->insertData('April');
        $this->insertData('May');
        $this->insertData('June');
        $this->insertData('July');
        $this->insertData('August');
        $this->insertData('September');
        $this->insertData('October');
        $this->insertData('November');
        $this->insertData('December');
    }

    private function insertData(string $text)
    {
        DB::table('months')->insert([
            'name' => $text,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
