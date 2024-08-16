<?php

namespace App\Models;

use CodeIgniter\Model;

class ErpMenuModel extends Model
{

	public function __construct()
	{
		parent::__construct();
		$this->db1 = $this->db;
	}


	var $t_head = 'erp_menu';
	var $t_head_key = 'erp_menu_id';
	var $column_order = array(null, 'ERP_MENU_NAME', 'WEB_PROMPT', 'TGL_EDIT', 'NOTE', NULL, NULL, NULL, NULL, NULL);
	var $column_search = array('w.WEB_PROMPT', 'e.KATA');


	function get_menu_table()
	{
		$w1 = "table_name is not null";
		$w2 = "table_name != ''";

		$this->db1->select("*");
		$this->db1->from('erp_menu a');
		$this->db1->where($w1);
		$this->db1->where($w2);
		$query = $this->db1->get();
		return $query->result();
	}

	function get_menu($erp_menu_name)
	{
		$this->db1->select("a.* , b.prompt as PARENT,c.CETAKAN_ID,c.CETAKAN_NAMA1,c.CETAKAN_NAMA2,c.CETAKAN_NAMA3,c.CETAKAN_FILE1,c.CETAKAN_FILE2,c.CETAKAN_FILE3,c.QUERY_HEADER,c.QUERY_DETAIL,c.QUERY_OTHER_H,c.QUERY_OTHER_D");
		$this->db1->from('erp_menu a');
		$this->db1->join('erp_menu b', 'a.parent_id = b.erp_menu_id', 'left');
		$this->db1->join('cetakan c', 'a.erp_menu_id = c.erp_menu_id', 'left');
		$this->db1->where('a.erp_menu_name', $erp_menu_name);
		$this->db1->limit(1);
		$query = $this->db1->get();
		//print_r($this->db1->last_query());
		return $query->row();
	}

	function get_datatables($par)
	{
		$this->_get_datatables_query();
		if (!empty($par)) {
			$this->db1->where('parent_id', $par);
		}
		/*Sept2018 if($_POST['length'] != -1)
		$this->db1->limit($_POST['length'], $_POST['start']);*/
		if ($this->input->post('length') != -1) //Sept2018
			$this->db1->limit($this->input->post('length'), $this->input->post('start')); //Sept2018

		$query = $this->db1->get();

		//print_r($this->db1->last_query());
		$value = array(
			'result' => $query->result(),
			'query' => $this->db1->last_query()
		);
		return $value;
	}

	private function _get_datatables_query()
	{
		$column_order = $this->column_order;
		$column_search = $this->column_search;

		/*
		$this->db1->select(" c.*, e.*, e1.erp_user_name as created_by_name, e2.erp_user_name as last_update_by_name");
		$this->db1->from('erp_menu e');
		$this->db1->join('erp_user e1', 'e.created_by=e1.erp_user_id','left');
		$this->db1->join('erp_user e2', 'e.last_update_by=e2.erp_user_id','left');
		$this->db1->join('erp_table et', 'et.erp_table_id=e.erp_table_id');
		$this->db1->join('cetakan c', 'c.erp_menu_id=e.erp_menu_id','left');
		$this->db1->where('e.active_flag','Y');
		*/

		$this->db1->select(" w.*,c.*, e.*, e1.erp_user_name as created_by_name, e2.erp_user_name as last_update_by_name,w2.web_prompt as p1, w3.web_prompt as p2");
		$this->db1->from('web_menu w');
		$this->db1->join('erp_menu e', 'e.erp_menu_id=w.erp_menu_id', 'left');
		$this->db1->join('web_menu w2', 'w.web_parent_id=w2.web_seq', 'left');
		$this->db1->join('web_menu w3', 'w2.web_parent_id=w3.web_seq', 'left');
		$this->db1->join('erp_user e1', 'e.created_by=e1.erp_user_id', 'left');
		$this->db1->join('erp_user e2', 'e.last_update_by=e2.erp_user_id', 'left');
		//$this->db1->join('erp_table et', 'et.erp_table_id=e.erp_table_id');
		$this->db1->join('cetakan c', 'c.erp_menu_id=e.erp_menu_id', 'left');
		$this->db1->where('e.active_flag', 'Y');
		$this->db1->order_by('w.erp_menu_id');

		$i = 0;

		foreach ($column_search as $item) // loop column 
		{
			//Sept2018 if($_POST['search']['value']) // if datatable send POST for search
			if ($this->input->post('search')['value']) // if datatable send POST for search
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

		// here order processing
		/* Sept2018 if(isset($_POST['order'])) {
			$c1 = $column_order[$_POST['order']['0']['column']];
			$c2 = $_POST['order']['0']['dir'];*/
		// here order processing
		if ($this->input->post('order')) { //Sept2018
			$c1 = $column_order[$this->input->post('order')['0']['column']];
			$c2 = $this->input->post('order')['0']['dir']; //Sept2018

			$this->db1->order_by($c1, $c2);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db1->order_by(key($order), $order[key($order)]);
		}
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db1->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db1->from($this->t_head);
		return $this->db1->count_all_results();
	}

	public function get_by_id($var_det_val)
	{
		$this->db1->from($this->t_head);
		$this->db1->join('cetakan c', 'c.erp_menu_id=erp_menu.erp_menu_id', 'left');
		$this->db1->join('web_menu w', 'w.erp_menu_id=erp_menu.erp_menu_id', 'left');
		$this->db1->where('erp_menu.erp_menu_id', $var_det_val);
		$query = $this->db1->get();
		// print_r($this->db1->last_query());
		return $query->row();
	}
	public function update_erp_menu($where, $data)
	{
		$this->db1->update($this->t_head, $data, $where);
	}
	public function update_cetakan($where, $data)
	{
		$this->db1->update('cetakan', $data, $where);
	}
	public function update_web_menu($where, $data)
	{
		$this->db1->update('web_menu', $data, $where);
	}

	function get_menu_list()
	{
		$this->db1->select("*");
		$this->db1->from('erp_menu');
		$this->db1->where('active_flag', 'Y');
		$this->db1->order_by("seq");

		$query = $this->db1->get();
		return $query->result();
	}
	function get_account()
	{

		$this->db1->select("*");
		$this->db1->from('erp_menu');
		$this->db1->order_by("erp_menu_id");

		$query = $this->db1->get();
		return $query->result();
	}




	public function update_menu($where, $data)
	{
		$this->db1->update('erp_menu', $data, $where);
		//print_r($this->db1->last_query());
		return true;
	}

	//2019 - get semua menu termasuk yang tidak aktif
	function get_all_menu_list()
	{
		$this->db1->select("*");
		$this->db1->from('erp_menu');
		$this->db1->order_by("seq");

		$query = $this->db1->get();
		return $query->result();
	}
}
