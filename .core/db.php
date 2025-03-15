<?php
class Database
{
    // Единственный существующий экземпляр данного класса
    private static $instance = null;

    // Экземпляр подключения к БД
    private $connection = null;

    // Запрещаем создание новых экземпляров снаружи класса
    protected function __construct()
    {
        $this->connection = new \PDO(
            'mysql:host=localhost;dbname=pizzeria',
            'root',
            '',
            [
                // В случае проблем выбрасывать исключения
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                // По умолчанию использовать имена столбцов
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

                // Не использовать эмуляцию подготовленных выражений
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }

    // Запрещаем клонирование
    protected function __clone()
    {
    }

    // Запрещаем десериализацию
    public function __wakeup()
    {
        throw new \BadMethodCallException('Unable to deserialize database connection.');
    }

    // Создает экземпляр класса, хранящий подключение к БД
    public static function getInstance() : Database
    {
        if (null === static::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    // Экземпляр подключения к БД
    public static function connection() : \PDO
    {
        return static::getInstance()->connection;
    }

    // Подготовленное выражение
    public static function prepare($statement) : \PDOStatement
    {
        return static::connection()->prepare($statement);
    }

    // ID последней добавленной записи
    public static function lastInsertId() : int
    {
        return intval(static::connection()->lastInsertId());
    }
}