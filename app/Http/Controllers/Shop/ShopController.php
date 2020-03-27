<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Service\Shop\ShopService as ShopShopService;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Service\Shop\ShopService;

class ShopController extends Controller
{
    private $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->middleware('auth:shop');
        $this->shopService = $shopService;
    }

    public function index()
    {
        $shopInfos = $this->shopService->fetchByShopId();
        return view('shop.index', compact('shopInfos'));
    }

    public function seats()
    {
        $seatStatus = $this->shopService->seatStatus();
        return view('shop.seats', compact('seatStatus'));
    }

    public function accounting()
    {
        
    }

    public function slip()
    {
        $todayOrders = $this->shopService->fetchTodayOrders();
        $dailyTotalAccounting = $this->shopService->todayTotalAccounting($todayOrders);
        return view('shop.slip', compact('dailyTotalAccounting', 'todayOrders'));
    }
}
