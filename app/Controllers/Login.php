<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class Login extends BaseController
{
    public function index()
    {
        $data['email'] = "";
        $data['password'] = "";

        $this->session->set('email', '');
        $this->session->set('logged', FALSE);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data['email'] = $this->request->getPost('email');
            $data['password'] = $this->request->getPost('password');

            if ($this->validation->run($this->request->getPost(), 'login')) {
                $model = new GeneralModel();
                $status = $model->checkPassword($data['email'], $data['password']);
                if ($status == 0) {
                    $data['error']['email'] = "No user with this email found.";
                }
                if ($status == 1) {
                    $this->session->set('email', $data['email']);
                    $this->session->set('logged', TRUE);
                    $model->setAttempts($data['email'],false);
                    return redirect()->to('home');
                }
                if ($status == -1) {
                    $attempts = $model->setAttempts($data['email'],true);
                    if($attempts <= 0){
                        $data['error']['password'] = "You've reached the maximum of attempts.";
                    }else{
                        $data['error']['password'] = "Wrong password, ".$attempts." attempts left.";
                    }
                }
            } else
                $data['error'] = $this->validation->getErrors();
        }
        return view('login', $data);
    }
}
