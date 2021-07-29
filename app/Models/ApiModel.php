<?php 

namespace App\Models;
use CodeIgniter\Model;

class ApiModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $allowedFields = [
      'Name', 
      'Email'
    ];
}