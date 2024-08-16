<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{


	protected $table = 'address';
	protected $primaryKey = 'ADDRESS_ID';
	protected $allowedFields = [
		'ADDRESS_CODE',
		'ADDRESS1',
		'ADDRESS2',
		'ADDRESS3',
		'SHIP_FLAG',
		'PRIMARY_SHIP_FLAG',
		'ACTIVE_FLAG',
		'CREATED_BY',
		'CREATED_DATE',
		'LAST_UPDATE_DATE',
		'LAST_UPDATE_BY',
		'CITY',
		'PROVINCE',
		'COUNTRY',
		'PHONE',
		'FAX',
		'NPWP',
		'NO_SERI_PAJAK',
		'NO_PKP',
		'TGL_PKP',
	];

	public function getUsers()
	{
		return $this->findAll();
	}
}
