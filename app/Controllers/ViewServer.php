<?php

namespace App\Controllers;

use App\Models\LinkedErpUserModel;
use App\Models\ServerModel;
use App\Models\ErpUserModel;

class ViewServer extends BaseController
{
    protected $linkedmodel;
    protected $erpusermodel;
    protected $servermodel;
    public function __construct()
    {
        $this->linkedmodel = new LinkedErpUserModel();
        $this->servermodel = new ServerModel();
        $this->erpusermodel = new ErpUserModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Tabel | Magang',
            'linked' => $this->linkedmodel->paginate(10, 'linked_erp_user'),
            'pager' => $this->linkedmodel->pager,
        ];
        return view('/views_user', $data);
    }
}
