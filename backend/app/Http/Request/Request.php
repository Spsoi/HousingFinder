<?php

namespace App\Http\Request;

class Request
{
    public $query;

    public function __construct()
    {
    }

    public function getQuery($key, $default = null)
    {
        return $this->query[$key] ?? $default;
    }

    public function setQuery($query)
    {
        return $this->query = $query;
    }

    public function get($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    public function post($key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    public function setPost($key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    public function input($key, $default = null)
    {
        return $_REQUEST[$key] ?? $default;
    }

    public function all()
    {
        return array_merge($_GET, $_POST);
    }
}
