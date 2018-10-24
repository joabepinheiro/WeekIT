<?php

namespace App;

use App\Http\DefaultModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Configuracoes extends AbstractModel 
{

  
    public function get($chave)
    {
        return \App\Configuracoes::where('chave', $chave)->first();
    }
    


}
