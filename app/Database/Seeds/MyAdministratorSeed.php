<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MyAdministratorSeed extends Seeder
{
  public function run()
  {
    $data = [
      'name' => 'admin',
      'email' => 'admin@test.com',
      'password' => 'master',
      'isAdministrator' => true,
    ];

    $this->db->table('users')->insertBatch($data);
  }
}