<?php

namespace App\Models;

use CodeIgniter\Model;

class LinkedErpUserModel extends Model
{
    protected $table = 'linked_erp_user';
    protected $primaryKey = 'LINKED_ERP_USER_ID';
    protected $allowedFields = [
        'ERP_USER_ID',
        'ERP_USER_EMAIL',
        'SERVER_ID',
        'PRIMARY_FLAG'
    ];

    public function getUsers()
    {
        return $this->findAll();
    }

    public function getLinked($LINKED_ERP_USER_ID = false)
    {
        if ($LINKED_ERP_USER_ID == false) {
            return $this->findAll();
        }

        return $this->where(['ERP_USER_ID' => $LINKED_ERP_USER_ID])->first();
    }

    public function search($cari)
    {
        return $this->table('linked_erp_user')->like('LINKED_ERP_USER_ID', $cari)->orLike('ERP_USER_ID', $cari)->orLike('ERP_USER_EMAIL', $cari)->orLike('SERVER_ID', $cari);
    }
}
