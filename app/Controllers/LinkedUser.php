<?php

namespace App\Controllers;

use App\Models\LinkedErpUserModel;
use App\Models\ServerModel;
use App\Models\ErpUserModel;

class LinkedUser extends BaseController
{
    protected $linkedmodel;
    protected $erpusermodel;
    protected $servermodel;
    public function __construct()
    {
        $this->linkedmodel = new LinkedErpUserModel();
        $this->servermodel = new ServerModel();
        $this->erpusermodel = new ErpUserModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Tabel | Magang',
            'datalinkeduser' => $this->linkedmodel->paginate(10, 'linked_erp_user'),
            'pager' => $this->linkedmodel->pager,
        ];
        return view('/linkeduser', $data);
    }
    public function showserver($SERVER_ID)
    {
        $builder = $this->servermodel->find($SERVER_ID);
        // dd($SERVER_ID);
        $dbname = $builder['DATABASE_NAME'];
        $hostname = $builder['HOSTNAME'];
        $port = $builder['PORT'];
        $username = getenv('db_username');
        $password = getenv('db_password');
        $Database3 = [
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
        try {
            $db1 = \Config\Database::connect($Database3);

            $builder = $db1->table('erp_user');
            $erpuser = $builder->get()->getResultArray();

            foreach ($erpuser as $key => $erp) {
                $linked = $this->linkedmodel;
                $linked->select('*')
                    ->where('SERVER_ID', $SERVER_ID)
                    ->where('ERP_USER_ID', $erp['ERP_USER_ID']);
                $linkederp = $linked->get()->getRowArray();
                if ($linkederp) {
                    $erpuser[$key]['ERP_USER_EMAIL'] = $linkederp['ERP_USER_EMAIL'];
                    $erpuser[$key]['LINKED_ERP_USER_ID'] = $linkederp['LINKED_ERP_USER_ID'];
                    $erpuser[$key]['PRIMARY_FLAG'] = $linkederp['PRIMARY_FLAG'];
                    $erpuser[$key]['SERVER_ID'] = $linkederp['SERVER_ID'];
                } else {
                    $erpuser[$key]['ERP_USER_EMAIL'] = null;
                    $erpuser[$key]['LINKED_ERP_USER_ID'] = null;
                    $erpuser[$key]['PRIMARY_FLAG'] = null;
                    $erpuser[$key]['SERVER_ID'] = $SERVER_ID;
                }
            }
            // dd($erpuser);
            $data = [
                'erpuser' => $erpuser,
                'server_id' => $SERVER_ID,
                'datalinkeduser' => $this->linkedmodel->where('SERVER_ID', $SERVER_ID)->paginate(10, 'linked_erp_user'),
                'pager' => $this->linkedmodel->pager,
            ];

            return view('/show_server_user', $data);
            // dd($data);
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return view('/errors/html/error_database');
        }
    }

    public function destroy($LINKED_ERP_USER_ID)
    {
        $linkuser = $this->linkedmodel->find($LINKED_ERP_USER_ID);
        $builder = $this->servermodel;
        $builder->select('*')
            ->where('SERVER_ID', $linkuser['SERVER_ID']);
        $server = $builder->get()->getRowArray();
        $dbname = $server['DATABASE_NAME'];
        $hostname = $server['HOSTNAME'];
        $port = $server['PORT'];
        $username = getenv('db_username');
        $password = getenv('db_password');
        $Database3 = [
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
        try {
            $db1 = \Config\Database::connect($Database3);

            $builder = $db1->table('erp_user');

            $builder->delete([
                'ERP_USER_ID' => $linkuser['ERP_USER_ID']
            ]);
            $success = $this->linkedmodel->delete($LINKED_ERP_USER_ID);
            if ($success) {
                session()->setFlashdata('message', 'Data berhasil dihapus');
                return redirect()->to('/linkeduser');
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return view('/errors/html/error_database');
        }
    }

    public function destroy_noemail($SERVER_ID, $ERP_USER_ID)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('linked_erp_user');
        $builder->select('*')
            ->where('ERP_USER_ID', $ERP_USER_ID)
            ->where('SERVER_ID', $SERVER_ID);
        $user = $builder->get()->getRowArray();

        $builder = $this->servermodel;
        $builder->select('*')
            ->where('SERVER_ID', $SERVER_ID);
        $server = $builder->get()->getRowArray();

        $dbname = $server['DATABASE_NAME'];
        $hostname = $server['HOSTNAME'];
        $port = $server['PORT'];
        $username = getenv('db_username');
        $password = getenv('db_password');
        $Database3 = [
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
        try {
            $db1 = \Config\Database::connect($Database3);

            $builder = $db1->table('erp_user');

            $builder->delete([
                'ERP_USER_ID' => $ERP_USER_ID
            ]);

            if ($user == null) {
                session()->setFlashdata('alert', 'Data berhasil dihapus');
                header("Location: /showserver/$SERVER_ID");
                exit;
            } else {
                $coba = $user['LINKED_ERP_USER_ID'];
                $success =  $this->linkedmodel->delete($coba);

                if ($success) {
                    session()->setFlashdata('alert', 'Data berhasil dihapus');
                    header("Location: /showserver/$SERVER_ID");
                    exit;
                }
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return view('/errors/html/error_database');
        }
    }

    public function update($LINKED_ERP_USER_ID)
    {
        $oldUsername = $this->request->getVar('old_username');

        $linkuser = $this->linkedmodel->find($LINKED_ERP_USER_ID);
        $builder = $this->servermodel;
        $builder->select('*')
            ->where('SERVER_ID', $linkuser['SERVER_ID']);
        $server = $builder->get()->getRowArray();
        $dbname = $server['DATABASE_NAME'];
        $hostname = $server['HOSTNAME'];
        $port = $server['PORT'];
        $username = getenv('db_username');
        $password = getenv('db_password');
        $Database3 = [
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
        try {
            $db1 = \Config\Database::connect($Database3);
            $userName = $this->request->getVar('username');
            $rules = [
                'email' => 'required|min_length[1]|max_length[30]|is_unique[linked_erp_user.ERP_USER_EMAIL,LINKED_ERP_USER_ID,' . $LINKED_ERP_USER_ID . ']',
            ];

            if ($this->validate($rules)) {

                if ($oldUsername != $userName) {
                    //cek apakah username sdh dipakai
                    $userNameCountUse = $db1->table('erp_user')
                        ->select('ERP_USER_ID')
                        ->where(['ERP_USER_NAME' => $userName])
                        // ->get()
                        ->countAllResults();
                    // dd($userNameCountUse);
                    if ($userNameCountUse > 0) {
                        session()->setFlashdata('error', 'Username already used');
                        return redirect()->back()->withInput();
                    }
                }

                // encrpyt password mysql version
                $pass = $this->request->getVar('password');
                $sql = "SELECT PASSWORD('$pass')";
                $query = $db1->query($sql);
                $hasil = $query->getRowArray();

                $group = $this->request->getVar('group');
                $builder = $db1->table('erp_group');
                $builder->select('ERP_GROUP_ID')
                    ->where(['ERP_GROUP_NAME' => $group]);
                $group_id = $builder->get()->getRowArray();

                // dd($group_id);
                // -encrpyt password mysql version-

                //update table erp_user
                $erpUserid = $this->request->getVar('erp_user_id');
                if ($this->request->getVar('password') == '') {
                    $data = [
                        'ERP_USER_ID' => $erpUserid,
                        'ERP_USER_NAME' => $userName,
                        'ERP_GROUP_ID' => $group_id,
                    ];
                    $builder = $db1->table('erp_user')
                        ->update($data, ['ERP_USER_ID' => $erpUserid]);
                } else {
                    $data = [
                        'ERP_USER_ID' => $erpUserid,
                        'ERP_USER_NAME' => $userName,
                        'PASSWORD' => $hasil,
                        'ERP_GROUP_ID' => $group_id,
                    ];
                    $builder = $db1->table('erp_user')
                        ->update($data, ['ERP_USER_ID' => $erpUserid]);
                }

                if ($this->request->getVar('flag') == null) {
                    $flag = 'N';
                } else {
                    $flag = 'Y';
                }
                $servers = $this->request->getVar('server_id');

                $this->linkedmodel->save([
                    'LINKED_ERP_USER_ID' => $LINKED_ERP_USER_ID,
                    'ERP_USER_EMAIL' => $this->request->getVar('email'),
                    'SERVER_ID' => $this->request->getVar('server_id'),
                    'ERP_USER_ID' => $this->request->getVar('erp_user_id'),
                    'PRIMARY_FLAG' => $flag,
                ]);



                // $this->erpusermodel->update($this->request->getVar('erp_user_id'), [
                //     'ERP_USER_NAME' => $this->request->getVar('username'),
                //     'PASSWORD' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                // ]);



                if ($this->request->getVar('redirect_server') == "N") {
                    session()->setFlashdata('pesan', 'Data berhasil diubah');
                    return redirect()->to('/linkeduser');
                } else {
                    session()->setFlashdata('pesan', 'Data berhasil diubah');
                    header("Location: /showserver/$servers");
                    exit;
                };
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return view('/errors/html/error_database');
        }
    }

    public function edit($LINKED_ERP_USER_ID)
    {
        $linkuser = $this->linkedmodel->find($LINKED_ERP_USER_ID);

        $builder = $this->servermodel;
        $builder->select('*')
            ->where('SERVER_ID', $linkuser['SERVER_ID']);
        $server = $builder->get()->getRowArray();

        $dbname = $server['DATABASE_NAME'];
        $hostname = $server['HOSTNAME'];
        $port = $server['PORT'];
        $username = getenv('db_username');
        $password = getenv('db_password');
        $Database3 = [
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
        try {
            $db1 = \Config\Database::connect($Database3);

            $builder = $db1->table('erp_user');
            $builder->select('*')
                ->where('ERP_USER_ID', $linkuser['ERP_USER_ID']);
            $user = $builder->get()->getRowArray();

            $builder1 = $db1->table('erp_group');
            $builder1->select('*');
            $group = $builder1->get()->getResultArray();

            $chekflag = '';
            if ($linkuser['PRIMARY_FLAG'] == 'Y') {
                $chekflag = 'checked';
            }

            $data = [
                'SERVER_ID' => $linkuser['SERVER_ID'],
                'ERP_USER_ID' => $user['ERP_USER_ID'],
                'ERP_USER_NAME' => $user['ERP_USER_NAME'],
                'PASSWORD' => $user['PASSWORD'],
                'ERP_GROUP' => $user['ERP_GROUP_ID'],
                'LINKED_ERP_USER_ID' => $linkuser['LINKED_ERP_USER_ID'],
                'ERP_USER_EMAIL' => $linkuser['ERP_USER_EMAIL'],
                'PRIMARY_FLAG' => $linkuser['PRIMARY_FLAG'],
                'CHEKED' => $chekflag,
                'redirect_server' => 'N',
                'erp_group' => $group,
            ];

            return view('edit_user', $data);
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return view('/errors/html/error_database');
        }
    }

    public function edit_noemail($SERVER_ID, $ERP_USER_ID)
    {
        // $linkuser = $this->linkedmodel->find($LINKED_ERP_USER_ID);
        $db = \Config\Database::connect();

        $ceklinked = $this->linkedmodel;
        $ceklinked->select('LINKED_ERP_USER_ID')
            ->where('SERVER_ID', $SERVER_ID)
            ->where('ERP_USER_ID', $ERP_USER_ID);
        $linked = $ceklinked->get()->getRowArray();
        if ($linked == null) {
            $data = [
                'ERP_USER_ID' => $ERP_USER_ID,
                'SERVER_ID' => $SERVER_ID,
            ];
            $builder = $db->table('linked_erp_user')
                ->insert($data);

            $builder = $this->linkedmodel;
            $builder->select('*')
                ->where('SERVER_ID', $SERVER_ID)
                ->where('ERP_USER_ID', $ERP_USER_ID);
            $linkuser = $builder->get()->getRowArray();
        } else {
            $builder = $this->linkedmodel;
            $builder->select('*')
                ->where('SERVER_ID', $SERVER_ID)
                ->where('ERP_USER_ID', $ERP_USER_ID);
            $linkuser = $builder->get()->getRowArray();
        }


        $builder = $this->servermodel;
        $builder->select('*')
            ->where('SERVER_ID', $SERVER_ID);
        $server = $builder->get()->getRowArray();

        $dbname = $server['DATABASE_NAME'];
        $hostname = $server['HOSTNAME'];
        $port = $server['PORT'];
        $username = getenv('db_username');
        $password = getenv('db_password');
        $Database3 = [
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
        try {
            $db1 = \Config\Database::connect($Database3);

            $builder = $db1->table('erp_user');
            $builder->select('*')
                ->where('ERP_USER_ID', $ERP_USER_ID);
            $user = $builder->get()->getRowArray();

            $builder1 = $db1->table('erp_group');
            $builder1->select('*');
            $group = $builder1->get()->getResultArray();

            $chekflag = '';
            if ($linkuser['PRIMARY_FLAG'] == 'Y') {
                $chekflag = 'checked';
            }

            $data = [

                'SERVER_ID' => $linkuser['SERVER_ID'],
                'ERP_USER_ID' => $user['ERP_USER_ID'],
                'ERP_USER_NAME' => $user['ERP_USER_NAME'],
                'PASSWORD' => $user['PASSWORD'],
                'ERP_GROUP' => $user['ERP_GROUP_ID'],
                'LINKED_ERP_USER_ID' => $linkuser['LINKED_ERP_USER_ID'],
                'ERP_USER_EMAIL' => $linkuser['ERP_USER_EMAIL'],
                'PRIMARY_FLAG' => $linkuser['PRIMARY_FLAG'],
                'CHEKED' => $chekflag,
                'redirect_server' => 'Y',
                'erp_group' => $group,
            ];

            return view('edit_user', $data);
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return view('/errors/html/error_database');
        }
    }
    public function create($server_id = NULL)
    {
        $data = [
            'server_id' => $server_id,
            'servers' => $this->servermodel->getServer(),

        ];
        // dd($data);
        return view('create_user', $data);
        // $servers = $this->servermodel->getServer();
        // return view('create_user', compact('servers'));

    }

    function get_erp_group()
    {
        $dbname = $this->request->getVar('id_server');
        $builder = $this->servermodel;
        $builder->select('*')
            ->where('DATABASE_NAME', $dbname);
        $server = $builder->get()->getRowArray();
        $hostname = $server['HOSTNAME'];
        $port = $server['PORT'];
        $username = getenv('db_username');
        $password = getenv('db_password');
        $Database3 = [
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
        $db1 = \Config\Database::connect($Database3);

        $group = $db1->table('erp_group');
        $data = $group->get()->getResultArray();
        // print_r($data);

        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        $lists = "<option>Pilih Dulu</option>";
        foreach ($data as $row) {
            $lists .= "<option value='" . $row['ERP_GROUP_ID'] . "'>" . $row['ERP_GROUP_NAME'] . "</option>"; // Tambahkan tag option ke variabel $lists
        }
        // print_r($lists);
        // exit;
        $callback = array('group_name' => $lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }

    public function store()
    {
        $dbname = $this->request->getVar('SERVER_ID');
        $userName = $this->request->getVar('username');

        $builder = $this->servermodel;
        $builder->select('*')
            ->where('DATABASE_NAME', $dbname);
        $server = $builder->get()->getRowArray();
        $hostname = $server['HOSTNAME'];
        $port = $server['PORT'];
        $username = getenv('db_username');
        $password = getenv('db_password');
        $Database3 = [
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
        try {
            $db1 = \Config\Database::connect($Database3);

            $rules = [
                'email' => 'required|min_length[1]|max_length[30]|is_unique[linked_erp_user.ERP_USER_EMAIL]',
            ];

            if ($this->validate($rules)) {
                //cek apakah username sdh dipakai
                $userNameCountUse = $db1->table('erp_user')
                    ->select('ERP_USER_ID')
                    ->where(['ERP_USER_NAME' => $userName])
                    // ->get()
                    ->countAllResults();
                // dd($userNameCountUse);
                if ($userNameCountUse > 0) {
                    session()->setFlashdata('error', 'Username already used');
                    return redirect()->back()->withInput();
                }
                $pass = $this->request->getVar('password');

                $sql = "SELECT PASSWORD('$pass')";
                $query = $db1->query($sql);
                $hasil = $query->getRowArray();

                if ($this->request->getVar('flag') == null) {
                    $flag = 'N';
                } else {
                    $flag = 'Y';
                }
                // dd($this->request->getVar('ERP_GROUP'));
                if ($this->request->getVar('ERP_GROUP') == "Pilih Dulu") {
                    session()->setFlashdata('error', 'Silahkan Pilih Erp Group Dulu');
                    return redirect()->back()->withInput();
                }

                // dd($flag);

                $data = [
                    'ERP_USER_NAME' => $this->request->getVar('username'),
                    'PASSWORD' => $hasil,
                    'ERP_GROUP_ID' => $this->request->getVar('ERP_GROUP'),

                ];
                $builder = $db1->table('erp_user')
                    ->insert($data);

                $server = $this->servermodel;
                $server->select('SERVER_ID')
                    ->where(['DATABASE_NAME' => $this->request->getVar('SERVER_ID'),]);
                $database = $server->get()->getRowArray();

                $builder1 = $db1->table('erp_user')
                    ->select('ERP_USER_ID')
                    ->where(['ERP_USER_NAME' => $this->request->getVar('username')]);
                $query = $builder1->get();
                $userid = $query->getRowArray();
                $servers = $database['SERVER_ID'];
                // dd($servers);
                $this->linkedmodel->save([
                    'ERP_USER_EMAIL' => $this->request->getVar('email'),
                    'SERVER_ID' => $database,
                    'ERP_USER_ID' => $userid['ERP_USER_ID'],
                    'PRIMARY_FLAG' => $flag,
                ]);
                session()->setFlashdata('msg', 'Data berhasil ditambah');
                header("Location: /showserver/$servers");
                exit;
                // return redirect()->to('/linkeduser');
            } else {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return view('/errors/html/error_database');
        }
    }

    public function hasilpencarian()
    {
        $cari = $this->request->getVar('cari');
        if ($cari) {
            $linked = $this->linkedmodel->search($cari);
        } else {
            $linked = $this->linkedmodel;
        }
        $dataa = [
            'title' => 'Tabel | Magang',
            'datalinkeduser' => $this->linkedmodel->paginate(10, 'linked_erp_user'),
            'pager' => $this->linkedmodel->pager,
        ];
        return view('/hasil_pencarian', $dataa);
    }
}
