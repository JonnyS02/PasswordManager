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
        if($result[0]['Attempts'] <= 0)
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

        $change = $this->db->table('users');
        $change->set('Attempts',$attempts);
        $change->update();
        $change->where('Email', $email);
        return $attempts;
    }

    public function getPasswords($email): array
    {
        $passwords = $this->db->table('passwords');
        $passwords->where('Email', $email);
        $passwords->select();
        $result = $passwords->get();
        return $result->getResultArray();
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

    public function deleteUser($email): string
    {
        $passwords = $this->db->table('passwords');
        $passwords->where('Email', $email);
        $passwords->delete();

        $user = $this->db->table('users');
        $user->where('Email', $email);
        $user->delete();

        return "deleted";
    }
}