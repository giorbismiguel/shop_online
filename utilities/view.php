<?php

class View
{
    /** @var String */
    protected $file;

    /** @var array */
    protected $data = [];

    /**
     * View constructor.
     *
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->data[$key];
    }

    /**
     * Print a file
     *
     * @throws Exception
     */
    public function output()
    {
        if (!file_exists($this->file)) {
            throw new Exception('Template '.$this->file.' doesn\'t exist.');
        }

        extract($this->data);

        ob_start();

        include($this->file);

        $output = ob_get_contents();

        ob_end_clean();

        echo $output;
    }

    /**
     * @param array $output
     *
     * @throws Exception
     */
    public function output_json($output = [])
    {
        if (!$output) {
            throw new Exception('The array is empty.');
        }

        echo json_encode($output);
    }
}
