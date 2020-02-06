<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
             'name'=>'creator',
             'primissions'=> json_encode([
               'create-product',
               'edit-product'
             ])
        ]);

        Role::create([
            'name'=>'editor',
            'primissions'=> json_encode([
              'edit-product'
            ])
       ]);

       Role::create([
        'name'=>'deletion',
        'primissions'=> json_encode([
          'delete-product'
        ])
   ]);

    }
}
