<?php
namespace Utils;
require_once "ValidationUtil.php";
require_once "DataUtil.php";
include "AuthenticationErrors.php";

class AuthenticationUtil
{
    private function __construct() {}

    public static function authorizationError(array $validation): array
    {
        $response = array();
        if (isset($validation['login']) and !$validation['login'])
        {
            $response['login'] = ERRORS['authorization_login_error'];
        }
        elseif (isset($validation['password']) and !$validation['password'])
        {
            $response['password'] = ERRORS['authorization_password_error'];
        }
        return $response;
    }

    public static function loginRegistrationError(string $login): string
    {
        $login = ValidationUtil::validateRegistrationLogin($login);
        $response = "";
        if (!$login['unique'])
        {
            $response = ERRORS['login_registration_error_exists'];
        }
        elseif (!$login['long'])
        {
            $response = ERRORS['login_registration_error_length'];
        }
        return $response;
    }

    public static function emailRegistrationError(string $email): string
    {
        $email = ValidationUtil::validateRegistrationEmail($email);
        $response = "";
        if (!$email['unique'])
        {
            $response = ERRORS['email_registration_error_exists'];
        }
        elseif (!$email['email'])
        {
            $response = ERRORS['email_registration_error_invalid'];
        }
        return $response;
    }

    public static function passwordRegistrationError(string $password): string
    {
        $response = "";
        if (!ValidationUtil::validateRegistrationPassword($password))
        {
            $response = ERRORS['password_registration_error'];
        }
        return $response;
    }

    public static function passwordRegistrationConfirmationError(string $password, string $passwordConfirmation): string
    {
        $response = "";
        if (!ValidationUtil::validateRegistrationPasswordConfirmation($password, $passwordConfirmation))
        {
            $response = ERRORS['password_registration_confirmation_error'];
        }
        return $response;
    }

    public static function nameRegistrationError(string $name): string
    {
        $name = ValidationUtil::validateRegistrationName($name);
        $response = "";
        if (!$name['literal'])
        {
            $response = ERRORS['name_registration_error_symbols'];
        }
        elseif (!$name['long'])
        {
            $response = ERRORS['name_registration_error_length'];
        }
        return $response;

    }

}