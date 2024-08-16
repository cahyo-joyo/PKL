<?php

namespace App\Controllers;

use App\Models\LinkedErpUserModel;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Seventhsoft | Magang'
        ];
        return view('admin/index', $data);
    }

    public function login()
    {
        return view('admin/login');
    }

    public function template()
    {
        $data = [
            'title' => 'Form Tambah Database',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/home', $data);
    }

    public function import()
    {
        $data = [
            'title' => 'Form Tambah Database',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/import', $data);
    }

    //--------------------------------------------------------------------

}
