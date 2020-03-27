<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Service\Shop\ShopService as ShopShopService;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Service\Shop\ShopService;
use Carbon\Carbon;

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
        $visitUsers = $this->shopService->visitUsers();
        return view('shop.seats', compact('visitUsers'));
    }

    public function accounting()
    {
        
    }

    public function slip()
    {
        $todayOrders = $this->shopService->fetchTodayOrders();
        $todayUserTotalAccounting = $this->shopService->slipTodayUserTotalAccounting();
        $dailyTotalAccounting = $this->shopService->todayTotalAccounting($todayOrders);

        return view('shop.slip', compact('dailyTotalAccounting', 'todayOrders', 'todayUserTotalAccounting'));
    }

    public function order($userId)
    {
        $orders = $this->shopService->fetchOrderByUserId($userId);
        $userPrice = $this->shopService->todayUserTotalAccounting($orders);

        return view('shop.order', compact('orders', 'userPrice'));
    }

    public function check(Request $request, $id)
    {
        // dd($request->all());
        $userId = $request->only('user_id');
        
        $orders = $this->shopService->fetchOrderByUserId($userId);
        $userPrice = $this->shopService->todayUserTotalAccounting($orders);
        $this->shopService->registerAccounting($id, $userPrice);

        return redirect()->route('shop.seats');
    }
}
