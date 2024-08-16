<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Seventhsoft | Magang'
        ];
        return view('login', $data);
    }

    //--------------------------------------------------------------------

}
