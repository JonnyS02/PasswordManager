<?php

namespace App\Controllers;

use App\Models\GeneralModel;
use CodeIgniter\HTTP\Header;

class Login extends BaseController
{
    public function index(): string
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data['email'] = $this->request->getPost('email');
            $data['password'] = $this->request->getPost('password');

            if ($this->validation->run($this->request->getPost(), 'login')) {
                $model = new GeneralModel();
                $status = $model->getUser($data['email'], $data['password']);
                if ($status == 0)
                    echo "No user with this email found";
                if ($status == 1)
                    return (new Home)->index($data['email']);
                if ($status == -1)
                    echo "Wrong password";

            } else {
                $data['error'] = $this->validation->getErrors();
                return view('login', $data);
            }
        }
        $data['email'] = "Test@test.de";
        $data['password'] = "Test";
        return view('login', $data);

    }
}
