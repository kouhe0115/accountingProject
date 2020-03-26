<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Shop\Auth;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:shop');
    }

    public function index()
    {
        return view('shop.index');
    }

    public function seats()
    {
        
    }

    public function accounting()
    {
        
    }
}
