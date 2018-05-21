В директории app/core находится ядро приложения: файлы реализующие паттерн MVC, обертка pdo для бд и...


Пример работы с базой данных
-------------------------------------
    $db = new Db();
    
    // Выборка одного значения
    $count = $db->queryValue('SELECT COUNT(*) FROM users');
    
    // Выборка набора записей
    $users = $db->queryRows('SELECT * FROM users WHERE name LIKE ?', array('%username%'));
    
    // Выборка одной записи
    $user = $db->queryRow('SELECT * FROM users WHERE id=:id', array(':id' => 123));
    
    // Добавление записи (INSERT) и получение значения поля AUTO_INCREMENT
    $newUserId = $db->insert('users', array('name' => 'NewUserName', 'password' => 'zzxxcc'));
    
    // Изменение записи (UPDATE)
    $db->update('users', array('name' => 'UpdatedName'), 'id=:id', array(':id' => $newUserId));

Работа с почтой
-----------------------
**Пример отправки письма**

    $mail = new Mail("no-reply@mysite.ru"); // Создаём экземпляр класса
      $mail->setFromName("Иван Иванов"); // Устанавливаем имя в обратном адресе
      if ($mail->send("abc@mail.ru", "Тестирование", "Тестирование<br /><b>письма<b>")) echo "Письмо отправлено";
      else echo "Письмо не отправлено";
      