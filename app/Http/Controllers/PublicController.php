<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController
{

    public function cadastrar(){
        return view('public.cadastrar');
    }

}
