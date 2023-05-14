<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public $data = [
        [
            'name' => 'Просмотр',
            'slug' => 'view',
        ],
        [
            'name' => 'Редактирование',
            'slug' => 'update',
        ],
        [
            'name' => 'Удаление',
            'slug' => 'delete',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data as $data){
            Permission::create($data);
        }
    }
}
