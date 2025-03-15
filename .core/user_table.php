<?php
class UserTable
{
    public static function create(
        string $email,
        string $full_name,
        string $birthday,
        string $address,
        string $gender,
        string $interests,
        string $vk,
        int $blood_type,
        string $factor,
        string $password
    )
    {
        $query = Database::prepare(
            'INSERT INTO `users` (`email`, `full_name`, `birthday`, `address`, `gender`, `interests`, `vk`, `blood_type`, `factor`, `password`)'
            . ' VALUES (:email, :full_name, :birthday, :address, :gender, :interests, :vk, :blood_type, :factor, :password)'
        );

        $query->bindValue(':email', $email);
        $query->bindValue(':full_name', $full_name);
        $query->bindValue(':birthday', $birthday);
        $query->bindValue(':address', $address);
        $query->bindValue(':gender', $gender);
        $query->bindValue(':interests', $interests);
        $query->bindValue(':vk', $vk);
        $query->bindValue(':blood_type', $blood_type);
        $query->bindValue(':factor', $factor);
        $query->bindValue(':password', $password);

        if (!$query->execute()) {
            throw new \PDOException('При добавлении пользователя возникла ошибка');
        }
    }

    public static function get_by_email(string $email) : ?array
    {
        return static::get_by_field('email', $email);
    }

    public static function get_by_id(int $id) : ?array
    {
        return static::get_by_field('id', $id);
    }

    private static function get_by_field(string $field, $value): ?array
    {
        $query = Database::prepare("SELECT * FROM `users` WHERE `$field` = :value LIMIT 1");
        $query->bindValue(':value', $value);
        $query->execute();

        $users = $query->fetchAll();
        if (!count($users)) {
            return null;
        }

        return $users[0];
    }
}