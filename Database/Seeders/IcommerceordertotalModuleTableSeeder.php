<?php

namespace Modules\Icommerceordertotal\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Isite\Entities\Module;

class IcommerceordertotalModuleTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();
    
    $columns = [
      ["config" => "config", "name" => "config"],
      ["config" => "crud-fields", "name" => "crud_fields"],
      ["config" => "permissions", "name" => "permissions"],
    ];
  
    $moduleRegisterService = app("Modules\Isite\Services\RegisterModuleService");
  
    $moduleRegisterService->registerModule("icommerceordertotal", $columns, 1);
  }
}
