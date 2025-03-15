<?php
class UserActions
{
    public static function signIn() : ?string
    {
        // TODO
        return null;
    }

    public static function signUp() : ?array
    {
        if ('POST' != $_SERVER['REQUEST_METHOD'] || 'signup' != $_POST['action']) {
            return null;
        }

        $errors = UserLogic::signUp(
            $_POST['email'],
            $_POST['full_name'],
            $_POST['birthday'],
            $_POST['address'],
            $_POST['gender'],
            $_POST['interests'],
            $_POST['vk'],
            $_POST['blood_type'],
            $_POST['factor'],
            $_POST['password1'],
            $_POST['password2']
        );

        if (!count($errors)) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?success=y');
            die();
        }

        return $errors;
    }
}