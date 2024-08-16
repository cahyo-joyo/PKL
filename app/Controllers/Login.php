<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\UsersModel;


class Login extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('login');
    }

    public function Auth()
    {
        $session = session();
        $model = new UsersModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('user_email', $email)->first();
        if ($data) {
            $pass = $data['user_password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'user_id'       => $data['user_id'],
                    'user_name'     => $data['user_name'],
                    'user_email'    => $data['user_email'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/home');
            } else {
                $session->setFlashdata('error', 'Wrong Password');
                return redirect()->to('/login');
                return redirect()->back()->withInput();
            }
        } else {
            $session->setFlashdata('error', 'Email not Found');
            return redirect()->to('/login');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
