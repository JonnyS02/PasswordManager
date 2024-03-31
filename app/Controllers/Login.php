<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        $this->session->destroy();
        return $this->returnView();
    }

    public function login()
    {
        $data['email'] = $this->request->getPost('email');
        $data['password'] = $this->request->getPost('password');

        if ($this->validation->run($this->request->getPost(), 'login')) {
            $status = $this->model->checkPassword($data['email'], $data['password']);
            if ($status == 0) {
                $data['error']['email'] = "No user with this email found.";
            }
            if ($status == 1) {
                $this->session->set('email', $data['email']);
                $this->session->set('logged', TRUE);
                $this->model->setAttempts($data['email'], false);
                if ($this->verifyEmail->isVerified($data['email']) == "0") {
                    return $this->verifyEmail->initVerify($data['email']);
                }
                return redirect()->to('home');
            }
            if ($status == -1) {
                $data['error']['password'] = $this->model->wrongPassword($data['email']);
            }
        } else {
            $data['error'] = $this->validation->getErrors();
        }

        return $this->returnView($data);
    }
}
