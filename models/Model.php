<?php

class Model
{
    /**
     * @var PDO
     */
    protected $db;

    /**
     * @var
     */
    protected $sql;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = Db::init();
    }

    /**
     * @param $sql
     */
    protected function setSql($sql)
    {
        $this->sql = $sql;
    }

    /**
     * @param null $data
     *
     * @return array
     * @throws Exception
     */
    public function getAll($data = null)
    {
        if (!$this->sql) {
            throw new Exception('No SQL query!');
        }

        $sth = $this->db->prepare($this->sql);
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
        if (!$this->sql) {
            throw new Exception('No SQL query!');
        }

        $sth = $this->db->prepare($this->sql);
        $sth->execute($data);

        return $sth->fetch();
    }
}
