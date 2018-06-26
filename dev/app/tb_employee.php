<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class tb_employee extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable,
        CanResetPassword;

      protected $table = "tb_employee";
      protected $primaryKey = "employee_id";
      public $incrementing = true;
      public $remember_token = false;

      CONST CREATED_AT = "employee_created_at";
      CONST UPDATED_AT = "employee_updated_at";

      public $fillable = ["employee_number", "employee_name", "employee_password"];

      
}
