<?php

namespace App\Controllers;

use App\Models\LinkedErpUserModel;

class CreateLinkedUser extends BaseController
{

    protected $linkedmodel;
    public function __construct()
    {
        $this->linkedmodel = new LinkedErpUserModel();
    }

    public function index()
    {
        $dataa = [
            'title' => 'Form Tambah Data Linked Erp User'
        ];
        $model = new LinkedErpUserModel();
        $linked = $model->getUsers();
        return view('create_linked', $dataa);
    }
}
