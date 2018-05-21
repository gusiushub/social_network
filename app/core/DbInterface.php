<?php

namespace app\core;


interface DbInterface
{

    /**
     * добавление поля в бд
     * @param $table
     * @param $fields
     * @param null $insertParams
     * @return mixed
     */
    public function insert($table, $fields, $insertParams = null);

    /**
     * обновление бд
     * @param $table
     * @param $fields
     * @param $where
     * @param null $params
     * @return mixed
     */
    public function update($table, $fields, $where, $params = null);

    /**
     * удаление поля из бд
     * @param $table
     * @param $where
     * @param $param
     * @return mixed
     */
    public function delete($table, $where, $param);

    /**
     * @param $query
     * @param null $params
     * @param $fetchStyle
     * @param null $classname
     * @return mixed
     */
    public function queryRow($query, $params = null, $fetchStyle = PDO::FETCH_ASSOC, $classname = null);

    /**
     * @param $query
     * @param null $params
     * @param $fetchStyle
     * @param null $classname
     * @return mixed
     */
    public function queryRows($query, $params = null, $fetchStyle = PDO::FETCH_ASSOC, $classname = null);
}