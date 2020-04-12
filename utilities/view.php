<?php

class View
{
    /** @var String */
    protected $_file;

    /** @var array */
    protected $_data = [];

    /**
     * View constructor.
     *
     * @param $file
     */
    public function __construct($file)
    {
        $this->_file = $file;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->_data[$key] = $value;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->_data[$key];
    }

    /**
     * Print a file
     * @throws Exception
     */
    public function output()
    {
        if (!file_exists($this->_file)) {
            throw new Exception('Template '.$this->_file.' doesn\'t exist.');
        }

        extract($this->_data);
        ob_start();

        include($this->_file);

        $output = ob_get_contents();

        ob_end_clean();

        echo $output;
    }
}
