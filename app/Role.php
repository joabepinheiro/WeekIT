<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Role extends AbstractModel
{
    protected $table                = 'roles';
    public static $base_name_route  = 'role';
    public static $verbose_name     = 'Papel';
    public static $verbose_plural   = 'Papeis';
    public static $verbose_genre    = 'M';
    public static $controller       = 'RoleController';


}
