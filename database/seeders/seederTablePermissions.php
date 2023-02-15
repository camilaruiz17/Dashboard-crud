
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//spatie
use Spatie\Permission\Models\Permission;

class seederTablePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //tabla roles
                    'see-rol',
                    'crear-rol',
                    'edit-rol',
                    'delete-rol',
                    // tabla scores
                    'see-score',
                    'crear-score',
                    'edit-score',
                    'delete-score',
                    ];
            
                    foreach($permissions as $permission) {
                        Permission::create(['name'=>$permission]);
                    }
    }
}
