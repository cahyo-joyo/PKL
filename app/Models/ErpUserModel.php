<?php

namespace App\Models;

use CodeIgniter\Model;


class ErpUserModel extends Model
{
    protected $DBGroup = 'Database2';
    protected $table = 'erp_user';
    protected $primaryKey = 'ERP_USER_ID';
    protected $allowedFields = [
        'ERP_USER_ID',
        'ERP_USER_NAME',
        'PASSWORD',
        'ADMIN_FLAG',
        'TEMPLATE_FLAG',
        'PROTECT_FLAG',
        'START_DATE',
        'END_DATE',
        'NOTE',
        'EMAIL_ID',
        'ERP_GROUP_ID',
        'CREATED_BY',
        'CREATED_DATE',
        'LAST_UPDATE_BY',
        'LAST_UPDATE_DATE',
        'TITLE',
        'ERP_USER_DESC'
    ];
    public function getUsers()
    {
        return $this->findAll();
    }
    public function getErp($ERP_USER_ID = false)
    {
        if ($ERP_USER_ID == false) {
            return $this->findAll();
        }

        return $this->where(['ERP_USER_ID' => $ERP_USER_ID])->first();
    }
}
