<?php
// Подключение к БД
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/db.php');

// Старт сессии
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/session.php');

// Все для работы с "пользователями"
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/user_table.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/user_logic.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/user_actions.php');