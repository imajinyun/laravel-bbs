<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = factory(Link::class)
            ->times(6)
            ->make()
            ->toArray();

        Link::insert($data);
    }
}
