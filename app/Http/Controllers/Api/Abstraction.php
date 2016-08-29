<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Abstraction extends Controller
{
    protected static function output($data)
    {
        return response()->json($data);
    }
}
