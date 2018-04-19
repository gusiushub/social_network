MVC framework using a namespace
================================

Installation
--------------
**The first step is cloning the base template
git clone https://github.com/gusiushub/social_network.git** <br>
**The minimum required PHP version is PHP 5.6.**

Directory Structure
----------------------

> _app/_
>> _config/_  - contains application configurations<br>
>> _controllers/_    -    contains Web controller classes<br>
>>_core/_<br>
>>_assets/_<br>
>>_cache/_<br>
>>_acl/_<br>
>>_modules/_<br>
>>_widgets/_<br>
>>_console/_<br>
 >>_lib_/<br>
>>_models/_  -   contains model classes<br>
>>_views/_   -  contains view files for the Web application<br>
>>> _account_/<br>
>>> _layouts_/<br>
>>>
> _public/_<br>
> _template/_<br>
>._htaccess_<br>
>._gitignore_<br>
>_index.php_<br>
>_public_/<br>
>_runtime/_  - contains files generated during runtime <br>

**PHP-MVC is an MVC framework written for PHP 5.6. It is in very early development (it's being written
alongside a web application) but is hoped to develop into a full framework in the process of creating
said web app. Because of this it's wise to take the framework with a pinch of salt - nearly all the
classes are documented and most of the core components work properly but there will only be as much
documentation as is necessary to configure the framework. A sample full version app is coming soon.
Now it's a social network that is in development**

Example of working with the database
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
Front end
----------    
**Css files and javascript are connected to the app \ assets directory by a separate class for each layout.
html css and javascript files are stored in the template folder**
