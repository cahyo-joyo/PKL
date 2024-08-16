<?php

namespace App\Controllers;

use App\Models\AddressModel;
use App\Models\ServerModel;
use App\Models\LinkedErpUserModel;

use App\Models\DropModel;
use App\Models\SetupModel;
use App\Models\CoaModel;
use App\Models\PeriodModel;
use App\Models\ErpMenuModel;
use App\Models\ErpNoModel;

class Persiapan extends BaseController
{
	protected $addressmodel;
	protected $servermodel;
	protected $setupmodel;
	protected $linkederpusermodel;

	protected $dropmodel;
	protected $coamodel;
	protected $periodmodel;
	protected $erpmenumodel;
	protected $erpnomodel;
	protected $Database3;

	public function __construct()
	{
		$this->addressmodel = new AddressModel();
		$this->servermodel = new ServerModel();
		$this->setupmodel = new SetupModel();
		$this->linkederpusermodel = new LinkedErpUserModel();

		$this->dropmodel = new DropModel();
		$this->coamodel = new CoaModel();
		$this->periodmodel = new PeriodModel();
		$this->erpmenumodel = new ErpMenuModel();
		$this->erpnomodel = new ErpNoModel();
	}

	public function index()
	// {
	// 	$data['dir'] = $this->uri->segment(1); //dir master	
	// 	$data['uri'] = $this->uri->segment(2); //class nilai	
	// 	$data['idu'] = $this->uri->segment(3); //fungsi preview
	// 	$data['par'] = $this->uri->segment(4); //paremeter 48
	// 	$head = $this->m_setup->get_setup_info();
	// 	$data['head'] = $head;
	// 	//redirect('login', 'refresh');
	// 	$cs = $this->auth->get_setup();
	// 	$data['setup'] = $this->setup;
	// 	$data['layout_content'] = 'v_fasilitas_persiapan';
	// 	if (isset($cs)) {
	// 		$data['layout_content'] = 'v_fasilitas_persiapan_edit';
	// 	}
	{
		$data = [
			'title' => 'Tabel | Magang',
			'dataalamat' => $this->addressmodel,
			'server' => $this->servermodel,
		];
		return view('/server/alamat', $data);
	}
	public function save()
	{

		// $date = null;
		// if ($this->request->getVar('date_pkp') != '') {
		// 	$date = date("Y-m-d", strtotime($this->request->getVar('date_pkp')));
		// }
		$address = $this->addressmodel;
		$address->select('ADDRESS_ID')
			->where(['ADDRESS1' => $this->request->getVar('address1'),]);

		$this->addressmodel->update($this->request->getVar('address1'), [
			'NPWP'				=> $this->request->getVar('npwp'),
			'NO_SERI_PAJAK'	  	=> $this->request->getVar('no_pajak'),
			'NO_PKP'	  		=> $this->request->getVar('no_pkp'),
			'TGL_PKP'	  		=> $this->request->getVar('tanggal'),
		]);

		$this->setupmodel->save([
			'NAME'				=> $this->request->getVar('name'),
			'LOGO_FILENAME'	  	=> $this->request->getVar('logo'),
			'ADDRESS_ID'	  	=> $this->request->getVar('address_id'),
			'EMAIL'		 	 	=> $this->request->getVar('email'),
		]);

		redirect('/server');
	}

	public function createalamat()
	{
		return view('/server/tambah_data_alamat');
	}

	public function storealamat()
	{
		//set rules validation form
		$rules = [
			// 'database' => 'required|min_length[1]|max_length[30]|is_unique[server.DATABASE_NAME]',
			// 'port' => 'required[server.PORT]',
			// 'max' => 'required[server.MAX_USER]'
		];

		if ($this->validate($rules)) {
			$database = new ServerModel();
			$dbname = $this->request->getVar('database');

			$data = [
				'DATABASE_NAME' => $dbname,
				'NAMA_PERUSAHAAN' => $this->request->getVar('perusahaan'),
				'ALAMAT_PERUSAHAAN' => $this->request->getVar('alamat'),
				'JENIS_USAHA' => $this->request->getVar('jenis'),
				'ACTIVE_DATE' => $this->request->getVar('tanggal'),
				'HOSTNAME' => $this->request->getVar('hostname'),
				'PORT' => $this->request->getVar('port'),
				'MAX_USER' => $this->request->getVar('max')
			];
			$database->save($data);
			session()->setFlashdata('msg', 'Data berhasil ditambah');
			return redirect()->to('/server');
		} else {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
	}

	public function store()
	{
		$date = null;
		if ($this->request->getVar('date_pkp') != '') {
			$date = date("Y-m-d", strtotime($this->request->getVar('date_pkp')));
		}

		$dataserver = $this->request->getVar('server_id');
		$database = $this->servermodel;
		$database->select('*')
			->where(['SERVER_ID' => $dataserver]);
		$server = $database->get()->getRowArray();
		$dbname = $server['DATABASE_NAME'];
		$hostname = 'localhost';
		$port = $server['PORT'];
		$username = 'root';
		$password = '';
		$this->Database3 = [
			'DSN'      => '',
			'hostname' => $hostname,
			'username' => $username,
			'password' => $password,
			'database' => $dbname,
			'DBDriver' => 'MySQLi',
			'DBPrefix' => '',
			'pConnect' => false,
			'DBDebug'  => (ENVIRONMENT !== 'production'),
			'cacheOn'  => false,
			'cacheDir' => '',
			'charset'  => 'utf8',
			'DBCollat' => 'utf8_general_ci',
			'swapPre'  => '',
			'encrypt'  => false,
			'compress' => false,
			'strictOn' => false,
			'failover' => [],
			'port'     => $port,
		];

		$db1 = \Config\Database::connect($this->Database3);

		$data1 = [
			'ADDRESS1' 			=> $this->request->getVar('address1'),
			'NPWP'				=> $this->request->getVar('npwp'),
			'NO_SERI_PAJAK'	  	=> $this->request->getVar('no_pajak'),
			'NO_PKP'	  		=> $this->request->getVar('no_pkp'),
			'TGL_PKP'	  		=> $date,
		];
		// $result = $this->addressmodel->update(array('ADDRESS_ID' => $this->request->getVar('address_id')), $data1);

		$address = $db1->table('address');

		$address->select('ADDRESS_ID')
			->where('ADDRESS_CODE', $this->request->getVar('address_code'))
			->update($data1);
		$addressid = $address->get()->getRowArray();

		$rules = [
			'email' => 'required|min_length[1]|max_length[30]',
		];

		if ($this->validate($rules)) {
			//set setup
			$data2 = [
				'NAME' => $this->request->getVar('name'),
				'ADDRESS_ID' => $addressid,
				'LOGO_FILENAME' => $this->request->getVar('logo'),
				'TEMPLATE_FOLDER' => 'TEMPLATE',
				'GAMBAR_FOLDER' => 'GAMBAR',
				'FREPORT_FOLDER' => NULL,
				'EXCEL_PASS' => NULL,
				'NO_TRANS' => 0,
				'STOCK_MIN' => 2,
				'LIMIT_PIUT_ORDER' => 2,
				'LIMIT_PIUT_JUAL' => 2,
				'QTYBD_PO' => 4,
				'QTYSJ_SO' => 4,
				'HARGA_SO' => 1,
				'HARGA_JUAL' => 1,
				'DISC_JUAL' => 1,
				'DIRECT_PRINT' => 0,
				'EXPORT_REPORT' => 0,
				'ERP_TABLE_ID' => NULL,
				'EMPTY_REPORT' => 1,
				'DISC_TOTAL_PERCEN' => 0,
				'TOOLBAR_COLOR' => '$00A6C2FF',
				'HEADER_COLOR' => '$00FFBFBF',
				'DETAIL_COLOR' => '$00FFBFBF',
				'GRID_COLOR' => '$00FFBFBF',
				'ROW_COLOR' => '$00FFCECE',
				'REPORT_COLOR' => '$00B3FFB3',
				'BILL_ROWCOUNT' => 10,
				'PEMBULATAN_PPN' => 0,
				'FLAG_TGL_ACC' => 0,
				'TGL_ACC' => NULL,
				'SCREEN_STOCK' => 1,
				'CHECK_MATCHING' => 2,
				'SHOW_HPP' => 3,
				'JURNAL_AWAL' => 2,
				'SIKLUS_BELI' => 2,
				'SIKLUS_JUAL' => 2,
				'SHOW_JUAL_BARCODE' => 1,
				'SHOW_JUAL_CASH' => 1,
				'QTY' => 1,
				'START_DATE' => $this->request->getVar('start_date'),
				'CUSTOM1' => '', //*QMRXo2qsC9>YNiZhjs4JGKU[Zjlâ€¦9<OZaZmczÆ’79
				'CUSTOM2' => 1, //ukuran form
				'CUSTOM3' => 'N',
				'CUSTOM4' => 'N',
				'CUSTOM5' => 'D:\NINESOFT\mysql',
				'CUSTOM6' => 'E26A',
				'CUSTOM7' => '2',
				'CUSTOM8' => NULL,
				'CUSTOM9' => NULL,
				'CUSTOM10' => NULL,
				'EMAIL'	=> $this->request->getVar('email'),
			];
			$builder = $db1->table('setup')
				->insert($data2);
			// $insert = $this->setupmodel->save($data2);

			$this->create_period($this->request->getVar('start_date'));
			$this->create_erp_no($this->request->getVar('start_date'));
			$this->create_coa_balance($this->request->getVar('start_date'));

			// if ($builder['status'] == true) {
			// 	//biyan $this->session->set_userdata('some_debug', $insert['query']);
			// }
			session()->setFlashdata('msg', 'Data Setup berhasil ditambah');
			return redirect()->to('/server');
			//redirect('facilities/persiapan');
			echo json_encode(array("status" => TRUE));
		} else {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
	}

	public function create_period($date)
	{
		$period_ym 	=  date("Ym", strtotime($date));

		$db1 = \Config\Database::connect($this->Database3);
		$period = $db1->table('period')
			->select('*')
			->where('PERIOD_NAME', $period_ym);
		$tblperiod = $period->get()->getRowArray();
		if ($tblperiod == false) {
			$data = [
				'PERIOD_NAME' => date("Ym", strtotime($date)),
				'PERIOD_DATE' => date("Y-m-d h:i:s", strtotime($date)),
				'YEARMONTH' => date("Ym", strtotime($date)),
				'YEAR' => date("Y", strtotime($date)),
				'MONTH' => date("n", strtotime($date)),
				'OPEN_FLAG' => 'Y',
				'START_DATE' => date("Y-m-d h:i:s", strtotime("first day of this month", strtotime($date))),
				'END_DATE' => date("Y-m-t h:i:s", strtotime("first day of this month", strtotime($date))),
				'PERIOD_AWAL' => NULL,
				'PERIODE' => strtoupper(date("M Y", strtotime("first day of this month", strtotime($date)))),
				'STOK_FLAG' => 0,

				// 'CREATED_BY' =>  $this->auth->get_id(),
				'CREATED_DATE' =>  date("Y-m-d h:i"),
				'LAST_UPDATE_DATE' =>  date("Y-m-d h:i"),
				// 'LAST_UPDATE_BY' => $this->auth->get_id(),
			];
			$value = $db1->table('period')
				->insert($data);
		};
	}
	public function create_erp_no($date)
	{
		$w1 = "table_name is not null";
		$w2 = "table_name != ''";
		$db1 = \Config\Database::connect($this->Database3);
		$erpmenu = $db1->table('erp_menu')
			->select('*')
			->where($w1)
			->where($w2);
		$menu_table = $erpmenu->get()->getResultArray();

		$period 	= date('Ym', strtotime($date));

		$erpno = $db1->table('erp_no')
			->select("*")
			->where('PERIOD_NAME', $period)
			// ->where('ERP_MENU_ID', $menu_table)
			->limit(1);

		$erp_no = $erpno->get()->getResultArray();
		// dd($erp_no);

		foreach ($menu_table as $tb) {
			if ($erp_no == false) {
				$data = [
					'ERP_NO_ID'  				=> "",
					'NO_TRANS_ID'				=> "0",
					'PERIOD_NAME'			  	=> $period,
					'ERP_MENU_ID'	  			=> $tb['ERP_MENU_ID'],
					// 'CREATED_BY'	  			=> $this->auth->get_id(),
					'CREATED_DATE'			  	=> date("Y-m-d 00:00:00"),
					'LAST_UPDATE_DATE'			=> date("Y-m-d 00:00:00"),
					// 'LAST_UPDATE_BY'	  		=> $this->auth->get_id(),
				];
				$value = $db1->table('erp_no')
					->insert($data);
				//print_r($result);
			}
		}
	}
	public function create_coa_balance($date)
	{
		$db1 = \Config\Database::connect($this->Database3);
		$coa = $db1->table('coa');
		$dataa = $coa->get()->getResultArray();
		foreach ($dataa as $ajx) {
			$data = [
				'COA_ID' 			=> $ajx['COA_ID'],
				'BALANCE_DATE' 		=> date("Y-m-d", strtotime($date)),
				'COA_SALDO' 		=> 0,
				'COA_DEBET' 		=> 0,
				'COA_CREDIT' 		=> 0,
				'PERIOD_NAME'		=> date("Ym", strtotime($date)),
				// 'CREATED_BY' 		=> $this->auth->get_id(),
				'CREATED_DATE' 		=> date("Y-m-d h:i"),
				'LAST_UPDATE_DATE' 	=> date("Y-m-d h:i"),
				// 'LAST_UPDATE_BY' 	=> $this->auth->get_id(),
			];
			$value = $db1->table('coa_balance')
				->insert($data);
		}
	}



	//PHASE 1
	// private function _validate()
	// {
	// 	$data = array();
	// 	$data['error_string'] = array();
	// 	$data['inputerror'] = array();
	// 	$data['status'] = TRUE;

	// 	if ($this->request->getVar('start_date') == '') {
	// 		$data['inputerror'][] = 'start_date';
	// 		$data['error_string'][] = 'tanggal mulai program is required';
	// 		$data['status'] = FALSE;
	// 	}

	// 	if ($this->request->getVar('name') == '') {
	// 		$data['inputerror'][] = 'name';
	// 		$data['error_string'][] = 'nama perusahaan is required';
	// 		$data['status'] = FALSE;
	// 	}

	// 	if ($this->request->getVar('email') != '') {
	// 		if (!filter_var($this->request->getVar('email'), FILTER_VALIDATE_EMAIL)) {
	// 			// invalid address
	// 			$data['inputerror'][] = 'email';
	// 			$data['error_string'][] = $this->error->get_invalid_email();
	// 			$data['status'] = FALSE;
	// 		}
	// 	}

	// 	if ($data['status'] === FALSE) {
	// 		echo json_encode($data);
	// 		exit();
	// 	}
	// }
}
