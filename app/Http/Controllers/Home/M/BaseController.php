<?php

namespace App\Http\Controllers\Home\M;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $theme;
    protected $msg = null;

    public function __construct(Request $request)
    {

    }
}
