<?php

namespace App\Controllers;

use App\Models\GeneralModel;
use Config\Services;

class User extends BaseController
{
    public function index(): string
    {
        $data['username'] = "";
        $data['email'] = "";
        $data['password'] = "";
        $data['repeatpassword'] = "";
        $data['agb'] = "";

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
                    $data['success'] = "Account created !";
                    $data['finished'] = true;
                    return $this->email->initVerify($data['email']);
                } else {
                    $data['error']['email'] = "Email is already in use.";
                }
            } else {
                $data['error'] = $this->validation->getErrors();
                if ($data['repeatpassword'] != $data['password'] && $data['repeatpassword'] != "" && $data['password'] != "") {
                    $data['error']['repeatpassword'] = "There was a typo in that password.";
                }
            }
        }
        return view('user', $data);
    }

    public function editProfile()
    {
        $data['finished'] = false;
        $data['success'] = "Edit Profile";

        if ($this->session->get('logged')) {
            $user = ($this->model->getUser($this->session->get('email')));

            $data['email'] = $user[0]['Email'];
            $data['username'] = $user[0]['Name'];

            return view('editUser', $data);
        } else
            return redirect()->to('login');
    }

    public function insertChangesProfile()
    {
        $data['finished'] = false;
        $data['success'] = "Edit Profile";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->session->get('logged')) {
                $data['username'] = $this->request->getPost('username');
                $data['email'] = $this->request->getPost('email');
                $data['password'] = $this->request->getPost('password');
                $data['repeatpassword'] = $this->request->getPost('repeatpassword');
                $data['changePassword'] = $this->request->getPost('changePassword');
                $data['password_old'] = $this->request->getPost('password_old');

                if ($this->validation->run($this->request->getPost(), 'insertChangesProfile')
                    && ($data['changePassword'] != "1" || ($data['changePassword'] == "1" && $data['password'] != "" && $data['repeatpassword'] != "" && $data['repeatpassword'] == $data['password']))) {

                    $status = $this->model->checkPassword($this->session->get('email'), $data['password_old']);
                    if ($status == -1) {
                        $attempts = $this->model->setAttempts($data['email'], true);
                        if ($attempts <= 0) {
                            $data['error']['password_old'] = "You've reached the maximum of attempts.";
                        } else {
                            $data['error']['password_old'] = "Wrong password, " . $attempts . " attempts left.";
                        }
                        return view('editUser', $data);
                    } else if ($status == 0) {
                        return redirect()->to('login');
                    } else {
                        if ($data['changePassword'] != "1")
                            $inserted = $this->model->insertChangesProfile($data['username'], $data['email'], $this->session->get('email'));
                        else
                            $inserted = $this->model->insertChangesProfile($data['username'], $data['email'], $this->session->get('email'), $data['password']);
                        if ($inserted) {
                            $this->session->set('email', $data['email']);
                            $data['success'] = "Profile changed !";
                            $data['finished'] = true;
                        } else {
                            $data['noChange'] = true;
                        }
                        return view('editUser', $data);
                    }
                } else {
                    $data['error'] = $this->validation->getErrors();

                    if ($data['changePassword'] == "1") {
                        if ($data['repeatpassword'] != $data['password'] && $data['password'] != "") {
                            $data['error']['repeatpassword'] = "There was a typo in that password.";
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
                    return view('editUser', $data);
                }
            }
        } else
            return $this->editProfile();
    }
}
