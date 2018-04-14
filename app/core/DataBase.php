<?php

namespace app\core;

use PDO;

class DataBase
{
    public $connection;

    public function __construct()
    {
        try
        {
            $config = require'app/config/db.php';

        $this->connection = new PDO('mysql:host='.$config['host'].';dbname='.$config['db_name'].'', $config['username'], $config['password']);
        }
        catch(PDOException $e)
        {
            die("Error: ".$e->getMessage());
        }
    }

    public function prepare($sql,$params=[])
    {
        $user = $this->connection->prepare($sql);
        $user->execute($params);
        return $user->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exec($sql,$params=[])
    {
        $data = $this->connection->prepare($sql);
        foreach ($params as $key => $val) {
            $data->bindParam(':'.$key, $val,PDO::PARAM_STR);
        }
        $data->execute();
        var_dump($data->execute());exit;

    }
}