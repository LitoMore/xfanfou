<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Abstraction extends Controller
{
    protected function output($data)
    {
        $code = ['code' => '0'];
        return response()->json(array_merge($code, $data));
    }
}
