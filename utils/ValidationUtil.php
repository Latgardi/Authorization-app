<?php

namespace Utils;
require_once "DataUtil.php";

class ValidationUtil
{
    private function __construct() {}

    public static function validateAuthorization(object $user): array
    {
        $response = array();
        $query['login'] = $user->login;
        $record = DataUtil::readRecord($query);
        if ($record)
        {
            $user->salt = $record['salt'];
            $user->hashPassword();
            if ($user->password == $record['password'])
            {
                $response['password'] = true;
            }
            else
            {
                $response['password'] = false;
            }
        }
        else
        {
            $response['login'] = false;
        }
        return $response;
    }

    public static function validateRegistrationLogin(string $login): array
    {
        $loginMinLength = 6;
        $isValid = (!preg_match('#\s#', $login));
        $isUnique = !DataUtil::readRecord(['login' => $login]);
        $isLong = strlen($login) > $loginMinLength;
        return array('valid' => $isValid, 'unique' => $isUnique, 'long' => $isLong);
    }

    public static function validateRegistrationEmail(string $email): array
    {
        $isUnique = !DataUtil::readRecord(['email' => $email]);
        $isEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        return array('unique' => $isUnique, 'email' => $isEmail);
    }

    public static function validateRegistrationPassword(string $password): bool
    {
        $passwordMinLength = 6;
        return preg_match('#^[a-zа-яё\d]+$#iu', $password) and strlen($password) > $passwordMinLength;
    }

    public static function validateRegistrationName(string $name): array
    {
        $nameMinLength = 2;
        $isLiteral = preg_match('#^[a-zа-яё]+$#iu', $name);
        $isLong = strlen($name) > $nameMinLength;
        return array('literal' => $isLiteral, 'long' => $isLong);
    }

    public static function validateRegistrationPasswordConfirmation($password, $passwordConfirmation): bool
    {
        return $password === $passwordConfirmation;
    }
}
