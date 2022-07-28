<?php
class User
{
    public $login;
    public $password;
    public $passwordConfirm;
    public $email;
    public $name;
    public $salt;

    public function __construct($login, $password, $passwordConfirm = null, $email = null, $name = null, $salt = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->passwordConfirm = $passwordConfirm;
        $this->email = $email;
        $this->name = $name;
        $this->salt = $salt;
    }

    public function getUserData(): array
    {
        return array("login" => $this->login, "password" => $this->password,
            "salt" => $this->salt, "email" => $this->email, "name" => $this->name);
    }

    public function setName()
    {
        $query['login'] = $this->login;
        $data = \Utils\DataUtil::readRecord($query);
        $this->name = $data['name'];
    }

    public function hashPassword()
    {
        if (!isset($this->salt))
        {
            $this->salt = $this->generateSalt();
        }
        $this->password = md5($this->salt . $this->password);
    }

    private function generateSalt(): string
    {
        $salt = "";
        $saltLength = 8;
        for ($i = 0; $i < $saltLength; $i++)
        {
            $salt .= chr(mt_rand(33, 126)); // ASCII characters
        }
        return $salt;
    }
}
