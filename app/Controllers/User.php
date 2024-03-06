<?php

namespace App\Controllers;

use App\Models\GeneralModel;
use Config\Services;

class User extends BaseController
{
    public function index(): string
    {
        $data['success'] = "Register";
        $data['finished'] = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data['username'] = $this->request->getPost('username');
            $data['email'] = $this->request->getPost('email');
            $data['password'] = $this->request->getPost('password');
            $data['repeatpassword'] = $this->request->getPost('repeatpassword');
            $data['agb'] = $this->request->getPost('agb');
            if ($this->validation->run($this->request->getPost(), 'register') && $data['repeatpassword'] == $data['password']) {
                if ($this->model->insertUser($data['username'], $data['password'], mt_rand(10000, 99999), $data['email'], 3)) {
                    return $this->verifyEmail->initVerify($data['email']);
                } else {
                    $data['error']['email'] = "Email is already in use.";
                }
            } else {
                $data['error'] = $this->validation->getErrors();
                if ($data['repeatpassword'] != $data['password'] && $data['repeatpassword'] != "" && $data['password'] != "") {
                    $data['error']['repeatpassword'] = "There is a typo in that password.";
                }
            }
        }
        return view('user', $data);
    }

    public function editProfile()
    {
        $data['finished'] = false;
        $data['success'] = "Edit Profile";
        if (!$this->session->get('logged')) {
            return redirect()->to('/');
        }
        $user = ($this->model->getUser($this->session->get('email')));
        $data['email'] = $user[0]['Email'];
        $data['username'] = $user[0]['Name'];
        return view('editUser', $data);

    }

    public function initializeData()
    {
        return [
            'finished' => false,
            'success' => "Edit Profile",
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'repeatpassword' => $this->request->getPost('repeatpassword'),
            'changePassword' => $this->request->getPost('changePassword'),
            'password_old' => $this->request->getPost('password_old')
        ];
    }

    public function validateNewPassword($data)
    {
        if (!$this->validation->run($this->request->getPost(), 'insertChangesProfile')) {
            $data['error'] = $this->validation->getErrors();
        }
        if ($data['changePassword'] == "1") {
            if ($data['repeatpassword'] != $data['password'] && $data['password'] != "") {
                $data['error']['repeatpassword'] = "There is a typo in that password.";
            }
            if ($data['password'] == "") {
                $data['error']['password'] = "The password field is required.";
            }
            if ($data['repeatpassword'] == "") {
                $data['error']['repeatpassword'] = "Please repeat your password.";
            }
        } else {
            $data['password'] = "";
            $data['repeatpassword'] = "";
        }
        return $data;
    }

    public function insertChangesProfile()
    {
        if (!$this->session->get('logged')) {
            return redirect()->to('/');
        }
        $data = $this->initializeData();
        $data = $this->validateNewPassword($data);
        if (!isset($data['error'])) {
            $status = $this->model->checkPassword($this->session->get('email'), $data['password_old']);
            if ($status == -1) {
                $data['error']['password_old'] = $this->model->wrongPassword($data['email']);
            } else if ($status == 0) {
                return redirect()->to('/');
            } else {
                if ($data['changePassword'] != "1") {
                    $inserted = $this->model->insertChangesProfile($data['username'], $data['email'], $this->session->get('email'));
                } else {
                    $inserted = $this->model->insertChangesProfile($data['username'], $data['email'], $this->session->get('email'), $data['password']);
                }
                if ($inserted) {
                    $this->session->set('email', $data['email']);
                    $data['success'] = "Profile changed !";
                    $data['finished'] = true;
                } else {
                    $data['noChange'] = true;

                }
            }
        }
        return view('editUser', $data);
    }
}
