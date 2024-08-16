<?php

namespace App\Models;

use CodeIgniter\Model;

class DropModel extends Model
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



    public function drop_ppn()
    {
        $this->db1->select('ppn_code, percentage');
        $this->db1->from('ppn');;
        $this->db1->where('active_flag', 'Y');
        $this->db1->order_by("ppn_code", "asc");
        $query = $this->db1->get();
        return $query;
    }

    public function drop_status()
    {
        $this->db1->select('B.erp_lookup_value_id as STATUS_ID, B.display_name AS STATUS');
        $this->db1->from('erp_lookup_set A');
        $this->db1->join('ERP_LOOKUP_VALUE B', 'A.ERP_LOOKUP_SET_ID = B.ERP_LOOKUP_SET_ID', 'inner');
        $this->db1->where('A.program_code', 'STATUS_ORDER');
        $this->db1->where('active_flag', 'Y');
        $this->db1->order_by("B.seq");
        $query = $this->db1->get();
        return $query;
    }

    public function drop_jenis()
    {
        $this->db1->select('B.DISPLAY_NAME as JENIS, ERP_LOOKUP_VALUE_ID AS STATUS_ID');
        $this->db1->from('erp_lookup_set A');
        $this->db1->join('ERP_LOOKUP_VALUE B', 'A.ERP_LOOKUP_SET_ID = B.ERP_LOOKUP_SET_ID', 'inner');
        $this->db1->where('PROGRAM_CODE', 'JENIS');
        $this->db1->where('active_flag', 'Y');
        $this->db1->order_by("B.primary_flag desc", "b.seq");
        $query = $this->db1->get();
        return $query;
    }
}
