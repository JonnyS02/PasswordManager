<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index(): string
    {
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->validation->run($this->request->getPost(), 'login')) {
                    echo "Erolg";
                } else {
                    $data['email'] = $this->request->getPost('email');
                    $data['password'] = $this->request->getPost('password');
                    $data['agb'] = $this->request->getPost('agb');

                    $data['error'] = $this->validation->getErrors();
                    return view('register', $data);
                }

            }
            return view('register');
        }
    }
}
