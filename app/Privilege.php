<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Privilege extends AbstractModel
{
    protected $table                = 'privileges';
    public static $base_name_route  = 'privileges';
    public static $verbose_name     = 'Privilégio';
    public static $verbose_plural   = 'Privilégios';
    public static $verbose_genre    = 'M';
    public static $controller       = 'PrivilegeController';

}
