<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'users';

  protected $allowedFields = ['name', 'email', 'password'];

  public static function isAdministrator($id)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('users');
    $builder->select('isAdministrator');
    $builder->where('id', $id);
    $query = $builder->get();
    $row = $query->getRow();
    return $row->isAdministrator;
  }
}