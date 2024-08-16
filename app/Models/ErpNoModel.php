<?php

namespace App\Models;

use CodeIgniter\Model;

class ErpNoModel extends Model
{

	var $t_head = 'erp_menu';
	var $t_head_key = 'erp_menu_id';
	var $t_detail = 'erp_no';
	var $t_detail_key = 'erp_no_id';

	public function __construct()
	{
		parent::__construct();
		$this->db1 = $this->db;
	}


	//UPDATE NO DOC
	public function get_update_no($menu, $yearmonth, $no_trans)
	{
		$this->db1->where('PERIOD_NAME', $yearmonth);
		$this->db1->where('ERP_MENU_ID', $menu);
		$this->db1->set('NO_TRANS_ID', $no_trans, FALSE);
		$this->db1->update('erp_no');
		return TRUE;
	}

	function get_is_available($val, $menu)
	{
		$this->db1->select("*");
		$this->db1->from('erp_no');
		$this->db1->where('PERIOD_NAME', $val);
		$this->db1->where('ERP_MENU_ID', $menu);
		$this->db1->limit(1);
		$query = $this->db1->get();
		if ($query->num_rows() == 0) {
			return false;
		} else {
			return true;
		};
	}

	function make_available($data)
	{
		$this->db1->insert('erp_no', $data);
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


	function get_no($menu, $period)
	{
		$this->db1->select("*");
		$this->db1->from('erp_no');
		if (!empty($period)) {
			$this->db1->where('period_name', $period);
		}
		$this->db1->where('erp_menu_id', $menu);
		$this->db1->order_by('period_name');
		$this->db1->limit(1);
		$query = $this->db1->get();
		//print_r($this->db1->last_query());
		return $query->row();
	}


	function get_datatables_detail($id)
	{
		$this->db1->select('erp_no.*');
		$this->db1->from($this->t_detail);
		$this->db1->join('period p', 'erp_no.period_name=p.period_name');
		$this->db1->where('p.open_flag', 'Y');
		$this->db1->where($this->t_head_key, $id);
		$this->db1->order_by('erp_no.period_name', 'desc');
		$query = $this->db1->get();
		//print_r($this->db1->last_query());
		return $query->result();
	}

	function get_datatables($id)
	{
		$this->_get_datatables_query($id);
		$query = $this->db1->get();
		return $query->result();
	}

	private function _get_datatables_query($id)
	{
		$this->db1->select('erp_no.*');
		$this->db1->from($this->t_detail);
		$this->db1->where($this->t_head_key, $id);
	}

	function count_filtered($id)
	{
		$this->_get_datatables_query($id);
		$query = $this->db1->get();
		return $query->num_rows();
	}

	public function count_all($id)
	{
		$this->db1->from($this->t_detail);
		$this->db1->where($this->t_head_key, $id);
		return $this->db1->count_all_results();
	}

	public function get_by_id($var_det_val)
	{
		$this->db1->from($this->t_detail);
		$this->db1->where($this->t_detail_key, $var_det_val);
		$query = $this->db1->get();
		return $query->row();
	}

	public function update_erp_no($where, $data)
	{
		$this->db1->update($this->t_detail, $data, $where);
		$value = array(
			'status' => true,
			'query' => $this->db1->last_query(),
			'error' => ''
		);

		if ($this->db1->error() > 0) {
			$a = $this->db1->error();

			//print_r($a['code']);
			if ($a['code'] == 0) {
				//echo "BREAK";
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
