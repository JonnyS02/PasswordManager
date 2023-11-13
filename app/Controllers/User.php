<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class User extends BaseController
{
    public function index(): string
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data['username'] = $this->request->getPost('username');
            $data['email'] = $this->request->getPost('email');
            $data['name'] = $this->request->getPost('name');
            $data['password'] = $this->request->getPost('password');
            $data['repeatpassword'] = $this->request->getPost('repeatpassword');
            $data['agb'] = $this->request->getPost('agb');

            if ($this->validation->run($this->request->getPost(), 'register') && $data['repeatpassword'] == $data['password']) {
                $model = new GeneralModel();
                $status = $model->inserUser($data['username'], $data['password'], true, $data['email']);
                echo $status;
            } else {
                $data['error'] = $this->validation->getErrors();
                if ($data['repeatpassword'] != $data['password'] && $data['repeatpassword'] != "")
                    $data['error']['repeatpassword'] = "There was a typo in that password.";

                return view('user', $data);
            }
        }
        $data['username'] = "Johan";
        $data['email'] = "Test@test.de";
        $data['name'] = "Johna";
        $data['password'] = "Test";
        $data['repeatpassword'] = "Test";
        $data['agb'] = "checked";
        return view('user', $data);
    }
}
