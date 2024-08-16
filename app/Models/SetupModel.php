<?php

namespace App\Models;

use CodeIgniter\Model;

class SetupModel extends Model
{
	public function __construct()
	{
		parent::__construct();
		/*
		$dsn1 = $this->auth->get_config();
		$this->db1 = $this->load->database($dsn1, true);
		$this->auth->set_variable();
		*/
		$this->db1 = $this->db;
	}

	public function get_setup()
	{
		$this->db1->select('*');
		$this->db1->from('setup');
		$query = $this->db1->get();
		return $query->row();
	}

	public function get_setup_info()
	{
		$this->db1->select('s.NAME, s.ADDRESS_ID, s.LOGO_FILENAME,s.START_DATE, s.EMAIL,a.ADDRESS1, a.PHONE');
		$this->db1->from('setup s');
		$this->db1->join('address a', 'a.ADDRESS_ID = s.ADDRESS_ID', 'left');

		$query = $this->db1->get();
		return $query->row();
	}
	public function cek_setup()
	{
		$this->db1->select('*');
		$this->db1->from('setup');
		$query = $this->db1->get();
		return $query;
	}

	public function save_setup($data)
	{
		$this->db1->insert('setup', $data);
		$value = array(
			'status' => true,
			'query' => $this->db1->last_query(),
			'error' => ''
		);

		if ($this->db1->error() > 0) {
			$a = $this->db1->error();
			if ($a['code'] == 0) {
				//break;
			} else {
				$value = array(
					'status' => false,
					'query' => $this->db1->last_query(),
					'error' => $a['code'] . ' ' . $a['message']
				);
			}
		}
		return $value;
	}

	// UNTUK UPDATE DATA	
	public function get_update($data)
	{
		//$this->db1->where('PO_ID', $po_id); //UBAH SESUAI PRIMARY KEY PADA TABEL
		$this->db1->update('setup', $data);
		$value = array(
			'status' => true,
			'query' => $this->db1->last_query(),
			'error' => ''
		);

		if ($this->db1->error() > 0) {
			$a = $this->db1->error();
			if ($a['code'] == 0) {
				//break;
			} else {
				$value = array(
					'status' => false,
					'query' => $this->db1->last_query(),
					'error' => $a['code'] . ' ' . $a['message']
				);
			}
		}
		return $value;
	}

	function make_available($data)
	{
		$this->db1->insert('setup', $data);
		$value = array(
			'status' => true,
			'query' => $this->db1->last_query(),
			'error' => ''
		);
		if ($this->db1->error() > 0) {
			$a = $this->db1->error();
			if ($a['code'] == 0) {
				//break;
			} else {
				$value = array(
					'status' => false,
					'query' => $this->db1->last_query(),
					'error' => $a['code'] . ' ' . $a['message']
				);
			}
		}

		//print_r($this->db1->last_query());
		return $value;
	}
}
