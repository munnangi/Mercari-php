<?php

namespace Coalition;

class ConfigRepository implements \ArrayAccess
{
    private $config_arr = array();


    /**
     * @param mixed $p_key
     * @param mixed $p_value
     */
    public function offsetSet ($p_key, $p_value) {
        if (is_null($p_key)) {
            $this->config_arr[] = $p_value;
        }
        else {
            $this->config_arr[$p_key] = $p_value;
        }
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function offsetExists($key) {
        return isset($this->config_arr[$key]);
    }

    /**
     * @param mixed $key
     */
    public function offsetUnset($key) {
        unset($this->config_arr[$key]);
    }

    /**
     * @param mixed $key
     * @return mixed|null
     */
    public function offsetGet($key) {
        return isset($this->config_arr[$key]) ? $this->config_arr[$key] : null;
    }



    /**
     * ConfigRepository constructor.
     * Comments- looping through the array and setting the config values
     * @param array $configVar_arr
     *
     */

    public function __construct($configVar_arr =array())
    {
        if(!empty($configVar_arr)) {
            foreach ($configVar_arr as $key => $value) {
                $this->config_arr[$key] = $value;
            }
        }

    }

    /**
     * Determine whether the config array contains the given key
     * Comments- Check the config array to see if the key is set. If it is set return true
     * else return false
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        if(array_key_exists($key,$this->config_arr))
            return true;
        else
            return false;
    }

    /**
     * Set a value on the config array
     *
     * @param string $key
     * @param mixed  $value
     * @return \Coalition\ConfigRepository
     */
    public function set($key, $value)
    {
        $this->config_arr[$key] = $value;
        return $this;
    }

    /**
     * Get an item from the config array
     *
     * If the key does not exist the default
     * value should be returned
     *
     * @param string     $key
     * @param null|mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
            if(array_key_exists($key,$this->config_arr))
                return $this->config_arr[$key];
            else
                return $default;
    }

    /**
     * Remove an item from the config array
     * comments -- throw an error, when there is no key found.
     * @param string $key
     * @return \Coalition\ConfigRepository
     */
    public function remove($key)
    {
        try {
            if (array_key_exists($key, $this->config_arr)) {
                unset($this->config_arr[$key]);
                return $this;
            }else{
                throw new \Exception("no key found");
            }
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
            return $this;
            die();
        }
    }

    /**
     * Load config items from a file or an array of files
     *
     * The file name should be the config key and the value
     * should be the return value from the file
     * 
     * @param array|string The full path to the files $files
     * @return void
     */
    public function load( $files)
    {

        if(is_array($files))
        {
            foreach ($files as $file) {
                if(file_exists($file))
                    $this->config_arr[basename($file,".php")] = include_once "$file";
            }
        }
        else{
            if(file_exists($files))
                $this->config_arr[basename($files,".php")] = include_once "$files";
        }
    }
}