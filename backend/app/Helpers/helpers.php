<?php

function response($data, $status = 200, $headers = [])
{
    http_response_code($status);

    // foreach ($headers as $key => $value) {
    //     header("$key: $value");
    // }

    // header('Content-Type: application/json');
    echo json_encode($data, 200, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}

if (!function_exists('env')) {
    /**
     * Get the value of the environment variable.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $path = dirname(__DIR__, 2) . '/.env';

        if (file_exists($path)) {
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                [$name, $value] = explode('=', $line, 2);
                if (trim($name) === $key) {
                    return trim($value);
                }
            }
        }

        return $default;
    }
}

function dd(...$vars) {
    foreach ($vars as $var) {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
    echo "</div>";
    die;
}