<?php

namespace App\Models;

use CodeIgniter\Model;

class ServerModel extends Model
{
    protected $table = 'server';
    protected $primaryKey = 'SERVER_ID';
    protected $allowedFields = ['DATABASE_NAME', 'CREATED_DATE', 'LAST_UPDATE_DATE', 'STATUS_FLAG', 'NAMA_PERUSAHAAN', 'ALAMAT_PERUSAHAAN', 'JENIS_USAHA', 'ACTIVE_DATE', 'HOSTNAME', 'PORT', 'MAX_USER'];

    public function getUsers()
    {
        return $this->findAll();
    }

    public function getServer($server_id = false)
    {
        if ($server_id == false) {
            return $this->findAll();
        }

        return $this->where(['server_id' => $server_id])->first();
    }

    public function search($cari)
    {
        return $this->table('server')->like('DATABASE_NAME', $cari)->orLike('NAMA_PERUSAHAAN', $cari)->orLike('ALAMAT_PERUSAHAAN', $cari)->orLike('JENIS_USAHA', $cari)->orLike('ACTIVE_DATE', $cari)->orLike('HOSTNAME', $cari)->orLike('PORT', $cari)->orLike('MAX_USER', $cari);
    }
}
