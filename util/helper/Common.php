<?php

/**
 * 配置静态资源路径
 */
if (!function_exists("assets")) {
    function assets($path)
    {
        if (!App::environment("production")) {
            return asset($path, false);
        }
        static $cdn = null;
        static $mainfest = null;
        if (is_null($cdn)) {
            $cdn = config('services.cdn');
        }
        if (is_null($mainfest)) {
            $manifest = json_decode(file_get_contents(public_path('build/rev-manifest.json')), true);
        }
        if (!isset($manifest[$path])) {
            throw new InvalidArgumentException("File {$path} not defined in asset manifest.");
        }
        return $cdn . '/' . $manifest[$path];
    }
}
