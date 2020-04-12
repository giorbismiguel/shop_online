<?php

class Model
{
    /**
     * @var PDO
     */
    protected $_db;

    /**
     * @var
     */
    protected $_sql;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->_db = Db::init();
    }

    /**
     * @param $sql
     */
    protected function _setSql($sql)
    {
        $this->_sql = $sql;
    }

    /**
     * @param null $data
     *
     * @return array
     * @throws Exception
     */
    public function getAll($data = null)
    {
        if (!$this->_sql) {
            throw new Exception('No SQL query!');
        }

        $sth = $this->_db->prepare($this->_sql);
        $sth->execute($data);
        return $sth->fetchAll();
    }

    /**
     * @param null $data
     *
     * @return mixed
     * @throws Exception
     */
    public function getRow($data = null)
    {
        if (!$this->_sql) {
            throw new Exception("No SQL query!");
        }

        $sth = $this->_db->prepare($this->_sql);
        $sth->execute($data);
        return $sth->fetch();
    }
}
