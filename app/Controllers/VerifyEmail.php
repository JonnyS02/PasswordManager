<?php

namespace App\Controllers;

use App\Models\GeneralModel;
use Config\Services;

class VerifyEmail extends BaseController
{
    public function initVerify($email): string
    {
        $this->sendVerifyMail($email);
        $data['headline'] = "Verify Email";
        $data['email'] = $email;
        return $this->returnView($data,'verify');
    }

    public function sendVerifyMail($emailTo)
    {
        $email = Services::email();
        $email->setFrom($this->emailServerAddress(), 'PassSafePro');
        $email->setTo($emailTo);
        $email->setSubject('Verify your email address.');
        $data['name'] = "Verification";
        $data['content'] = "Thank you for choosing PassSafePro.<br>Complete the registration by verifying your email address.";
        $data['do'] = "Verify email address";
        $model = new GeneralModel();
        $code = $model->getUser($emailTo)[0]["Verified"];
        $data['link'] = base_url("index.php/verify?verifyCode=" . $code . "&email=" . $emailTo);
        $email->setMessage(view('mailTemplate', $data));
        $email->send();
    }

    public function isVerified($email = ""): string
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $this->request != null) {
            $email = $this->request->getPost('email');
        }
        $model = new GeneralModel();
        $isVerified = $model->getUser($email);
        return isset($isVerified[0]["Verified"]) && $isVerified[0]["Verified"] == 1 ? "1" : "0";
    }

    public function verified()
    {
        if (isset($_GET['email']) and $this->isVerified($_GET['email']) == "1") {
            $data['headline'] = "Email verified!";
            $data['main'] = true;
            return $this->returnView($data,'verified');
        }
        return redirect()->to('/');
    }

    public function verify()
    {
        if (isset($_GET['verifyCode']) && isset($_GET['email'])) {
            $verifyCode = $_GET['verifyCode'];
            $email = $_GET['email'];
            if ($this->model->verifyUser($verifyCode, $email)) {
                $data['headline'] = "Email verified!";
                return $this->returnView($data,'verified');
            }
        }
        return redirect()->to('/');
    }
}
