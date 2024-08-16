<?php

namespace App\Models;

use CodeIgniter\Model;

class CoaModel extends Model
{

	var $t_detail = 'coa_setup';
	var $t_detail_key = 'coa_id';

	var $column_order = array('NOTE', 'COA_NAME');

	var $column_search = array('NOTE', 'COA_NAME');


	var $order = array('NOTE'); // default order 
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




	function get_detail()
	{

		$this->db1->select("*");
		$this->db1->from('coa_setup');
		$this->db1->order_by("account_id");

		$query = $this->db1->get();
		return $query->result();
	}




	private function _get_datatables_query()
	{
		$column_order = $this->column_order;
		$column_search = $this->column_search;

		/////$this->db1->from($this->t_detail);
		//$this->db1->where($this->t_head_key,$var_val);
		$this->db1->select("s.*,c.COA_NAME as COA_NAME");
		$this->db1->from('coa_setup s');
		$this->db1->join('coa c', 'c.account_id=s.account_id', 'left');



		$i = 0;

		//foreach ($this->column_search as $item) // loop column 

		foreach ($column_search as $item) // loop column 
		{
			if ($_POST['search']['value']) // if datatable send POST for search
			{

				if ($i === 0) // first loop
				{
					$this->db1->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db1->like($item, $_POST['search']['value']);
				} else {
					$this->db1->or_like($item, $_POST['search']['value']);
				}

				//if(count($column_search) - 1 == $i) //last loop
				if (count($column_search) - 1 == $i) //last loop
					$this->db1->group_end(); //close bracket
			}
			$i++;
		}

		if (isset($_POST['order'])) // here order processing
		{

			$c1 = $column_order[$_POST['order']['0']['column']];
			$c2 = $_POST['order']['0']['dir'];

			//print_r($c1);
			//print_r($c2);

			//$this->db1->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			$this->db1->order_by($c1, $c2);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db1->order_by($order[key($order)]);
			//$this->db1->order_by(key($order), $order[key($order)]);
		}
	}

	//PHASE 1
	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db1->limit($_POST['length'], $_POST['start']);
		$query = $this->db1->get();
		return $query->result();
	}


	// COUNTER COUNTER COUNTER COUNTER COUNTER COUNTER COUNTER 
	// COUNTER COUNTER COUNTER COUNTER COUNTER COUNTER COUNTER 

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db1->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db1->from($this->t_detail);
		//$this->db1->where($this->t_head_key,$var_val);
		return $this->db1->count_all_results();
	}

	// GETID GETID GETID GETID GETID GETID GETID GETID GETID
	// GETID GETID GETID GETID GETID GETID GETID GETID GETID

	//public function get_by_id($id)
	public function get_by_id($var_det_val)
	{
		//$this->db1->from($this->table);
		$this->db1->select("s.*,c.COA_NAME as COA_NAME");
		$this->db1->from('coa_setup s');
		$this->db1->join('coa c', 'c.account_id=s.account_id');
		$this->db1->where('s.coa_id', $var_det_val);
		$query = $this->db1->get();

		return $query->row();
	}

	// DML DML DML DML DML DML DML DML DML DML DML DML DML DML
	// DML DML DML DML DML DML DML DML DML DML DML DML DML DML	

	public function save_coa($data)
	{
		//$this->db1->insert($this->table, $data);
		$this->db1->insert($this->t_detail, $data);
		return $this->db1->insert_id();
	}

	public function update_coa($where, $data)
	{
		$this->db1->update($this->t_detail, $data, $where);
		return $this->db1->affected_rows();
	}

	public function delete_by_id($id)
	{
		//$this->db1->where('id', $id);
		$this->db1->where($this->t_detail_key, $id);
		//$this->db1->delete($this->table);
		$this->db1->delete($this->t_detail);
	}

	//////////////

	public function get_all_coa()
	{
		//$this->db1->from($this->table);
		$this->db1->select('*');
		$this->db1->from('coa');
		$query = $this->db1->get();

		return $query->result();
	}

	public function insert_coa_balance($data)
	{
		//$this->db1->insert($this->table, $data);
		$this->db1->insert('coa_balance', $data);
		return $this->db1->insert_id();
	}
}
