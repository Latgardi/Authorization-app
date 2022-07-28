<?php
namespace Auth;

require_once "utils/AuthenticationUtil.php";
require_once "utils/DataUtil.php";
require_once "utils/ValidationUtil.php";

use Utils\AuthenticationUtil;
use Utils\DataUtil;
use Utils\ValidationUtil;

class Authentication
{
    private function __construct() {}

    public static function buildRegistrationResponse(object $user): array
    {
        $response = array();
        $loginError = AuthenticationUtil::loginRegistrationError($user->login);
        $passwordError = AuthenticationUtil::passwordRegistrationError($user->password);
        $passwordConfirmationError = AuthenticationUtil::passwordRegistrationConfirmationError($user->password, $user->passwordConfirm);
        $emailError = AuthenticationUtil::emailRegistrationError($user->email);
        $nameError = AuthenticationUtil::nameRegistrationError($user->name);
        if (!empty($loginError))
        {
            $response['errors']['login_error'] = $loginError;
        }
        if (!empty($passwordError))
        {
            $response['errors']['password_error'] = $passwordError;
        }
        if (!empty($passwordConfirmationError))
        {
            $response['errors']['confirm_error'] = $passwordConfirmationError;
        }
        if (!empty($emailError))
        {
            $response['errors']['email_error'] = $emailError;
        }
        if (!empty($nameError))
        {
            $response['errors']['name_error'] = $nameError;
        }
        $success = empty($response);
        $response['success'] = $success;
        return array("response" => json_encode($response), "success" => $success);

    }

    public static function buildLoginResponse(object $user): array
    {
        $response = array();
        $validation = ValidationUtil::validateAuthorization($user);
        $errors = AuthenticationUtil::authorizationError($validation);
        $loginError = $errors['login'] ?? null;
        $passwordError = $errors['password'] ?? null;
        if (!empty($loginError))
        {
            $response['errors']['login_error'] = $loginError;
        }
        if (!empty($passwordError))
        {
            $response['errors']['password_error'] = $passwordError;
        }
        $success = empty($response);
        $response['success'] = $success;
        return array("response" => json_encode($response), "success" => $success);


    }
    public static function registerUser($user)
    {
        $user->hashPassword();
        DataUtil::createRecord($user->getUserData());
        self::loginUser($user);
    }

    public static function loginUser(object $user)
    {
        $cookieLifeTime = strtotime('+30 days');
        $user->setName();
        $_SESSION['auth'] = 1;
        $_SESSION['name'] = $user->name;
        setcookie('auth', 1, $cookieLifeTime);
        setcookie('name', $user->name, $cookieLifeTime);
    }

    public static function isAuthorized(): bool
    {
        return isset($_SESSION['auth']);
    }

    public static function logout()
    {
        setcookie('auth', '', time());
        setcookie('name', '', time());
        session_destroy();
        header('location: /');
    }
}