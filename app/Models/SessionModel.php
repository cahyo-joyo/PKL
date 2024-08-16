<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table = 'session';
    protected $primaryKey = 'SESSION_ID';
    protected $allowedFields = ['ERP_USERS_ID', 'IP_ADDRESS', 'CREATED_DATE', 'LAST_UPDATE_DATE', 'NOTE'];

    public function getUsers()
    {
        return $this->findAll();
    }

    public function getSession($session_id = false)
    {
        if ($session_id == false) {
            return $this->findAll();
        }

        return $this->where(['SESSION_ID' => $session_id])->first();
    }

    public function search($cari)
    {
        return $this->table('session')->like('ERP_USERS_ID', $cari)->orLike('IP_ADDRESS', $cari)->orLike('CREATED_DATE', $cari)->orLike('LAST_UPDATE_DATE', $cari)->orLike('NOTE', $cari);
    }
}
