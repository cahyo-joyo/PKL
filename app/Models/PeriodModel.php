<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodModel extends Model
{

	var $column_order = array('MONTH', 'PERIODE', 'PERIOD_DATE', 'YEAR', 'START_DATE', 'END_DATE', 'OPEN_FLAG');
	var $column_search = array('ITEM_DESCRIPTION', 'ENTERED_UOM', 'PRICE_BUY', 'PRICE_SELL1', 'DISC_PRICE', 'DISC_PERCEN', 'GROUP_ID');
	var $order = array('OPEN_FLAG desc'); // default order 

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


	function get_is_available($val)
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->where('PERIOD_NAME', $val);
		$this->db1->limit(1);
		$query = $this->db1->get();
		if ($query->num_rows() == 0) {
			return false;
		} else {
			return true;
		};
	}


	function is_open($val)
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->where('PERIOD_NAME', $val);
		$this->db1->limit(1);
		$query = $this->db1->get();
		$row = $query->row();
		//print_r($this->db1->last_query());
		if ($query->num_rows() > 0) {
			if ($row->OPEN_FLAG == "Y") {
				return false;
			} else {
				return true;
			};
		} else {
			return true;
		}
	}

	function make_available($data)
	{
		$this->db1->insert('period', $data);
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


	function get_period_closed()
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->where('OPEN_FLAG', "N");
		$this->db1->order_by("yearmonth", 'desc');
		$query = $this->db1->get();

		//print_r($this->db1->last_query());
		return $query->result();
	}
	function get_period_closed_last()
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->where('OPEN_FLAG', "N");
		$this->db1->order_by("yearmonth", "desc");
		$this->db1->limit(1);
		$query = $this->db1->get();

		//print_r($this->db1->last_query());
		return $query->row();
	}

	function get_period_active_last()
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->where('OPEN_FLAG', "Y");
		$this->db1->order_by("yearmonth", "desc");
		$this->db1->limit(1);
		$query = $this->db1->get();

		//print_r($this->db1->last_query());
		return $query->row();
	}
	function get_period_active_first()
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->where('OPEN_FLAG', "Y");
		$this->db1->order_by("yearmonth", "asc");
		$this->db1->limit(1);
		$query = $this->db1->get();

		//print_r($this->db1->last_query());
		return $query->row();
	}

	function get_period_active()
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->where('OPEN_FLAG', "Y");
		$this->db1->order_by("yearmonth");
		$this->db1->limit(1);
		$query = $this->db1->get();

		//print_r($this->db1->last_query());
		return $query->row();
	}
	function get_list_period_active()
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->where('OPEN_FLAG', "Y");
		$this->db1->order_by("yearmonth desc");
		$query = $this->db1->get();

		//print_r($this->db1->last_query());
		return $query->result();
	}


	function get_period_non_active()
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->where('OPEN_FLAG', "N");
		$this->db1->order_by("yearmonth", 'desc');
		$this->db1->limit(1);
		$query = $this->db1->get();

		return $query->row();
	}

	function get_period_max()
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->order_by("yearmonth", 'desc');
		$this->db1->limit(1);
		$query = $this->db1->get();
		//print_r($this->db1->last_query());
		return $query->row();
	}
	function get_period_min()
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->order_by("yearmonth", 'asc');
		$this->db1->limit(1);
		$query = $this->db1->get();
		//print_r($this->db1->last_query());
		return $query->row();
	}

	function get_year()
	{
		$this->db1->select('*');
		$this->db1->from('period');
		$this->db1->group_by('year');
		$this->db1->order_by("year", 'desc');
		$query = $this->db1->get();
		return $query->result();
	}

	function get_all_period()
	{
		$this->db1->select("*");
		$this->db1->from('period');
		$this->db1->order_by("yearmonth", 'desc');
		$query = $this->db1->get();

		//print_r($this->db1->last_query());
		return $query->result();
	}

	function get_end_date($period)
	{
		$this->db1->select("END_DATE");
		$this->db1->from('period');
		$this->db1->where('PERIOD_NAME', $period);
		$query = $this->db1->get();

		//print_r($this->db1->last_query());
		return $query->row();
	}

	function closing($where, $data)
	{
		$this->db1->update('period', $data, $where);
		return $this->db1->affected_rows();
	}

	function undo_closing($where, $data)
	{
		$this->db1->update('period', $data, $where);
		return $this->db1->affected_rows();
	}

	function get_datatables($par)
	{
		$this->_get_datatables_query($par);
		if ($_POST['length'] != -1)
			$this->db1->limit($_POST['length'], $_POST['start']);
		$query = $this->db1->get();

		//print_r($this->db1->last_query()) ;
		return $query->result();
	}


	private function _get_datatables_query($par)
	{
		$column_order = $this->column_order;
		$column_search = $this->column_search;

		$this->db1->from('period');

		if ($par) {
			$this->db1->where('year', $par);
		}

		$i = 0;
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

			$this->db1->order_by($c1, $c2);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db1->order_by($order[key($order)]);
			//$this->db1->order_by(key($order), $order[key($order)]);
		}
		$this->db1->order_by('YEARMONTH asc');
	}

	function count_filtered($par)
	{
		$this->_get_datatables_query($par);
		$query = $this->db1->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db1->from('period');
		return $this->db1->count_all_results();
	}

	/* 2020 Add */
	function add_period($data)
	{
		$this->db1->replace('period', $data);
		$value = array(
			'status' => true,
			'query' => $this->db1->last_query(),
			'error' => ''
		);
		if ($this->db1->error() > 0) {
			$a = $this->db1->error();
			if ($a['code'] <> 0) {
				$value = array(
					'status' => false,
					'query' => $this->db1->last_query(),
					'error' => $a['code'] . ' ' . $a['message']
				);
			}
		}

		return $value;
	}

	function exec_query($query = null)
	{
		$this->db1->query($query);
	}
}
