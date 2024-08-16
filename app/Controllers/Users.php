<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{

    protected $usersmodel;
    public function __construct()
    {
        $this->usersmodel = new UsersModel();
    }

    public function index()
    {
        $dataa = [
            'title' => 'Tabel | Magang'
        ];
        $users = new UsersModel();
        $dataadmin = $users->getUsers();
        return view('users', compact('dataadmin'), $dataa);
    }

    public function destroy($user_id)
    {
        $success = $this->usersmodel->delete($user_id);
        if ($success) {
            session()->setFlashdata('message', 'Data berhasil dihapus');
            return redirect()->to('/users');
        }
    }

    public function register()
    {
        //include helper form
        helper(['form']);
        $data = [];
        echo view('register', $data);
    }

    public function store_admin()
    {
        //include helper form
        helper(['form']);
        $data = [];
        echo view('register2', $data);
    }
    public function save()
    {
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'name'          => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $model = new UsersModel();
            $data = [
                'user_name'     => $this->request->getVar('name'),
                'user_email'    => $this->request->getVar('email'),
                'user_password' => $this->request->getVar('password'),
            ];
            $model->save($data);
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
    }
    public function edit($user_id)
    {
        $user = $this->usersmodel->find($user_id);
        $dataa = [
            'title' => 'Tabel | Magang',
            'user_id'       => $user['user_id'],
            'user_name'     => $user['user_name'],
            'user_email'    => $user['user_email'],
            'user_password' => $user['user_password'],
        ];
        // dd($user_id);
        return view('reset_password', $dataa);
    }

    public function update($user_id)
    {
        // $user = $this->datamodel->find($user_id);
        //set rules validation form
        $rules = [
            'user_name'          => 'required|min_length[3]|max_length[20]',
            'user_email'          => 'required|min_length[3]|max_length[100]|is_unique[users.user_email,user_id,' . $user_id . ']',
            // 'user_password'      => 'required|min_length[6]|max_length[200]',
        ];

        if ($this->validate($rules)) {
            $model = new UsersModel();
            if ($this->request->getVar('user_password') == '') {
                $data = [
                    'user_id'       => $user_id,
                    'user_name'     => $this->request->getVar('user_name'),
                    'user_email'    => $this->request->getVar('user_email'),
                ];
                $model->save($data);
            } else {
                $data = [
                    'user_id'       => $user_id,
                    'user_name'     => $this->request->getVar('user_name'),
                    'user_email'    => $this->request->getVar('user_email'),
                    'user_password' => password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT)
                ];
                $model->save($data);
            }

            // dd($data);
            return redirect()->to('/users');
        } else {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // return view('reset_password');
    }
    public function store()
    {
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'name'          => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[100]|valid_email|is_unique[users.user_email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $model = new UsersModel();
            $data = [
                'user_name'     => $this->request->getVar('name'),
                'user_email'    => $this->request->getVar('email'),
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
    }
    public function store2()
    {
        //include helper form

        //set rules validation form
        $rules = [
            'name'          => 'required|min_length[3]|max_length[100]',
            'email'         => 'required|min_length[5]|max_length[100]|valid_email|is_unique[users.user_email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $model = new UsersModel();
            $data = [
                'user_name'     => $this->request->getVar('name'),
                'user_email'    => $this->request->getVar('email'),
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/users');
        } else {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
    }
}
