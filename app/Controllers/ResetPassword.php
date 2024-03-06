<?php

namespace App\Controllers;

use App\Models\GeneralModel;
use Config\Services;

class ResetPassword extends BaseController
{
    public function index()
    {
        if (isset($_GET['email'])) {
            $email = $_GET['email'];
            $status = $this->model->checkPassword($email, "");
            if ($status == 0) {
                return redirect()->to('/');
            }
            $code = $this->model->settAttemptsCode($email);
            $data['success'] = "Reset Password";
            $data['email'] = $email;
            $this->sendResetEmail($email, $code);
            return view('verifyReset', $data);
        }
        return redirect()->to('/');
    }

    public function sendResetEmail($emailTo, $code)
    {
        $email = Services::email();
        $email->setFrom('date.manager@jonathan-stengl.de', 'PassSafePro official');
        $email->setTo($emailTo);
        $email->setSubject('Reset your Password.');
        $data['name'] = "Reset password";
        $data['content'] = "The password for your account was entered incorrectly 3 times.<br>Please choose a new password to continue using your account.";
        $data['do'] = "Reset your password";
        $data['link'] = base_url("index.php/insertResetPassword?xyz=" . $code . "&email=" . $emailTo);
        $email->setMessage(view('mailTemplate', $data));
        $email->send();
    }

    public function insertResetPassword()
    {
        if (isset($_GET['email']) and isset($_GET['xyz'])) {
            $user = $this->model->getUser($_GET['email']);
            if (count($user) == 0 || $user[0]['Attempts'] >= 0) {
                return redirect()->to('/');
            }
            $data['email'] = $_GET['email'];
            $data['xyz'] = $_GET['xyz'];
            $data['username'] = $user[0]['Name'];
            $data['success'] = "Reset Password";
            if ($user[0]['Attempts'] == $_GET['xyz']) {
                $data['link'] = base_url("index.php/abortReset?xyz=" . $data['xyz'] . "&email=" . $data['email']);
                return view('insertResetPassword', $data);
            }
        }
        return redirect()->to('/');
    }

    public function submitResetPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if ($this->request->getPost('password') !== null and $this->request->getPost('password') != "") {
                $data['password'] = $this->request->getPost('password');
            } else {
                $data['error']['password'] = "The password field is required.";
            }
            if ($this->request->getPost('repeatpassword') !== null and $this->request->getPost('repeatpassword') != "") {
                $data['repeatpassword'] = $this->request->getPost('repeatpassword');
            } else {
                $data['error']['repeatpassword'] = "Please repeat your password.";
            }
            if (!isset($data['error']['password']) and !isset($data['error']['repeatpassword'])) {
                if ($data['repeatpassword'] != $data['password']) {
                    $data['error']['repeatpassword'] = "There is a typo in that password.";
                }
            }
            if ($this->request->getPost('email') !== null and $this->request->getPost('email') != "") {
                $data['email'] = $this->request->getPost('email');
            } else {
                return redirect()->to('/');
            }
            if ($this->request->getPost('xyz') !== null and $this->request->getPost('xyz') != "") {
                $data['xyz'] = $this->request->getPost('xyz');
            } else {
                return redirect()->to('/');
            }
            if ($this->request->getPost('username') !== null and $this->request->getPost('username') != "") {
                $data['username'] = $this->request->getPost('username');
            } else {
                return redirect()->to('/');
            }
            $data['link'] = base_url("index.php/abortReset?xyz=" . $data['xyz'] . "&email=" . $data['email']);
            $user = $this->model->getUser($data['email']);
            if (count($user) == 0 || $user[0]['Attempts'] >= 0) {
                return redirect()->to('/');
            }
            if ($user[0]['Attempts'] == $data['xyz'] and !isset($data['error'])) {
                $this->model->insertChangesProfile($user[0]['Name'], $user[0]['Email'], $user[0]['Email'], $data['password']);
                $this->model->dbAttempts(3, $user[0]['Email']);
            }
            $data['success'] = "Reset Password";
            if (isset($data['error'])) {
                return view('insertResetPassword', $data);
            } else {
                return $this->resetVerified();
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function abortReset()
    {
        if (isset($_GET['email']) and isset($_GET['xyz'])) {
            $user = $this->model->getUser($_GET['email']);
            if ($user[0]['Attempts'] >= 0) {
                return redirect()->to('/');
            }
            if ($user[0]['Attempts'] == $_GET['xyz']) {
                $this->model->dbAttempts(0, $user[0]['Email']);
            }
        }
        return redirect()->to('/');
    }

    public function isReset()
    {
        $data['email'] = $this->request->getPost('email');
        $user = $this->model->getUser($data['email']);
        if (count($user) == 0) {
            return redirect()->to('/');
        }
        $attempts = $user[0]['Attempts'];
        echo $attempts <= 0 ? 0 : 1;
    }

    public function resetVerified()
    {
        $data['success'] = "Password reset!";
        return view('verifiedReset', $data);
    }
}