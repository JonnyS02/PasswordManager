<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
    public function insertUser($name, $password, $verified, $email, $attempts): string
    {
        if (sizeof($this->getUser($email)) != 0)
            return false;

        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = [
            'Name' => $name,
            'Password' => $password,
            'Verified' => $verified,
            'Email' => $email,
            'Attempts' => $attempts,
        ];

        $this->db->table('users')->insert($user);
        return true;
    }

    function getUser($email): array
    {
        $user = $this->db->table('users');
        $user->where('Email', $email);
        $user->select();
        $result = $user->get();
        return $result->getResultArray();
    }

    public function checkPassword($email, $password): int
    {
        $result = $this->getUser($email);

        if (sizeof($result) == 0)
            return 0;
        if ($result[0]['Attempts'] <= 0)
            return -1;
        if (password_verify($password, $result[0]['Password']))
            return 1;
        return -1;
    }

    public function setAttempts($email, $decrease)
    {
        $attempts = $this->getUser($email)[0]['Attempts'];
        if ($attempts <= 0)
            return 0;
        if ($decrease)
            $attempts = $attempts - 1;
        else
            $attempts = 3;
        $this->dbAttempts($attempts, $email);
        return $attempts;
    }

    public function dbAttempts($attempts, $email)
    {
        $change = $this->db->table('users');
        $change->set('Attempts', $attempts);
        $change->where('Email', $email);
        $change->update();
    }

    public function settAttemptsCode($email): int
    {
        $attempts = -(mt_rand(10000000000000000, 99999999999999999));
        $this->dbAttempts($attempts, $email);
        return $attempts;
    }

    public function getPasswords($email, $id = ""): array
    {
        $passwords = $this->db->table('passwords');
        $passwords->where('Email', $email);
        if ($id != "")
            $passwords->where('ID', $id);
        $passwords->select();
        $result = $passwords->get();
        return $result->getResultArray();
    }

    function getUserAuto(): array
    {
        $user = $this->db->table('users');
        $user->select();
        $result = $user->get();
        return $result->getResultArray();
    }

    function deleteUserAuto($email): bool
    {
        $user = $this->db->table('users');
        $user->where('Email', $email);
        $user->delete();
        return true;
    }

    public function insertPassword($plattform, $password, $username, $additional, $email): bool
    {
        if ($this->getPlattform($plattform, $email)) {
            $password = [
                'Plattform' => $plattform,
                'Password' => $password,
                'Username' => $username,
                'Additional' => $additional,
                'Email' => $email,
            ];
            $this->db->table('passwords')->insert($password);
            return true;
        }
        return false;
    }

    public function updatePassword($plattform, $username, $additional, $email, $oldPlattform, $changePassword, $password)
    {
        $passwordEntry = $this->db->table('passwords');
        if ($changePassword) {
            $passwordEntry->set('Password', $password);
            $this->submitUpdate($passwordEntry, $email, $oldPlattform);
        }
        $passwordEntry->set('Username', $username);
        $this->submitUpdate($passwordEntry, $email, $oldPlattform);
        $passwordEntry->set('Additional', $additional);
        $this->submitUpdate($passwordEntry, $email, $oldPlattform);
        $passwordEntry->set('Plattform', $plattform);
        $this->submitUpdate($passwordEntry, $email, $oldPlattform);
    }

    public function submitUpdate($database, $email, $id)
    {
        $database->where('Email', $email);
        $database->where('Plattform', $id);
        $database->update();
    }


    public function deletePassword($passwordID, $email)
    {
        $passwords = $this->db->table('passwords');
        $passwords->where('ID', $passwordID);
        $passwords->where('Email', $email);
        $passwords->delete();
    }

    public function getPlattform($plattform, $email): bool
    {
        $passwords = $this->db->table('passwords');
        $passwords->where('Plattform', $plattform);
        $passwords->where('Email', $email);
        $passwords->select();
        $result = $passwords->get();
        $result = $result->getResultArray();
        return sizeof($result) == 0;
    }

    public function deleteUser($email, $password): bool
    {
        if ($this->checkPassword($email, $password) == -1)
            return false;

        $passwords = $this->db->table('passwords');
        $passwords->where('Email', $email);
        $passwords->delete();

        $passwords = $this->db->table('dates');
        $passwords->where('Email', $email);
        $passwords->delete();

        $user = $this->db->table('users');
        $user->where('Email', $email);
        $user->delete();

        return true;
    }

    public function insertChangesProfile($name, $email, $oldEmail, $password = ""): bool
    {
        $oldUser = $this->getUser($oldEmail);
        if ($oldUser[0]['Name'] == $name && $oldUser[0]['Email'] == $email && (password_verify($password, $oldUser[0]['Password']) || $password == ""))
            return false;

        if ($password == "") {
            $updated_user = [
                'Name' => $name,
                'Email' => $email,
            ];
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $updated_user = [
                'Name' => $name,
                'Password' => $password,
                'Email' => $email,
            ];
        }

        $change = $this->db->table('users');
        $change->where('Email', $oldEmail);
        $change->update($updated_user);

        if ($oldEmail != $email) {
            $change_email = $this->db->table('dates');
            $change_email->set('Email', $email);
            $change_email->where('Email', $oldEmail);
            $change_email->update();

            $change_email = $this->db->table('passwords');
            $change_email->set('Email', $email);
            $change_email->where('Email', $oldEmail);
            $change_email->update();
        }
        return true;
    }

    public function verifyUser($verifyCode, $email): bool
    {
        $user = $this->getUser($email);
        if (sizeof($user) != 0) {
            if ($user[0]["Verified"] == "1")
                return true;
            if ($user[0]["Verified"] == $verifyCode) {
                $verify = $this->db->table('users');
                $verify->set('Verified', 1);
                $verify->where('Email', $email);
                $verify->update();
                return true;
            }
        }
        return false;
    }

    public function wrongPassword($email): string
    {
        $attempts = $this->setAttempts($email, true);
        if ($attempts <= 0) {
            $response = "You've reached the maximum of attempts.";
            $url = "resetPassword" . "?email=" . urlencode($email);
            $response .= '&nbsp <a href=' . $url . '> Reset password</a>';
        } else {
            $response = "Wrong password, " . $attempts . " attempts left.";
        }
        return $response;
    }
}