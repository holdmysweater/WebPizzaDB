<?php
class UserLogic
{
    public static function signUp(
        string $email,
        string $full_name,
        string $birthday,
        string $address,
        string $gender,
        string $interests,
        string $vk,
        int $blood_type,
        string $factor,
        string $password1,
        string $password2
    ) : ?array
    {
        // TODO
        return null;
    }

    public static function signIn(string $email, string $password) : ?string
    {
        if (static::isAuthorized()) {
            return 'Вы уже авторизованы';
        }

        $user = UserTable::get_by_email($email);
        if (null == $user) {
            return 'Пользователь с таким email не найден';
        }

        if (password_hash($password, PASSWORD_DEFAULT) != $user['password']) {
            return 'Неверно указан пароль';
        }

        $_SESSION['USER_ID'] = $user['id'];

        return null;
    }

    public static function signOut()
    {
        unset($_SESSION['USER_ID']);
    }

    public static function isAuthorized() : bool
    {
        return intval($_SESSION['USER_ID']) > 0;
    }

    public static function current() : ?array
    {
        if (!static::isAuthorized()) {
            return null;
        }

        return UserTable::get_by_id($_SESSION['USER_ID']);
    }
}