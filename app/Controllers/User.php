<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class User extends BaseController
{
    public function index(): string
    {
        $data['username'] = "";
        $data['email'] = "";
        $data['name'] = "";
        $data['password'] = "";
        $data['repeatpassword'] = "";
        $data['agb'] = "";

        $data['success'] = "Register";
        $data['finished'] = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data['username'] = $this->request->getPost('username');
            $data['email'] = $this->request->getPost('email');
            $data['name'] = $this->request->getPost('name');
            $data['password'] = $this->request->getPost('password');
            $data['repeatpassword'] = $this->request->getPost('repeatpassword');
            $data['agb'] = $this->request->getPost('agb');

            if ($this->validation->run($this->request->getPost(), 'register') && $data['repeatpassword'] == $data['password']) {
                $model = new GeneralModel();
                if($model->insertUser($data['username'], $data['password'], true, $data['email'],3)){
                    $data['success'] = "Account created !";
                    $data['finished'] = true;
                }else{
                    $data['error']['email'] ="Email is already in use.";
                }
            } else {
                $data['error'] = $this->validation->getErrors();
                if ($data['repeatpassword'] != $data['password'] && $data['repeatpassword'] != "") {
                    $data['error']['repeatpassword'] = "There was a typo in that password.";
                }
            }
        }
        return view('user', $data);
    }
}
