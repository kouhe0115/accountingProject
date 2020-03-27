<?php

namespace App\Service\Shop;

use App\Shop;
use App\Slip;
use App\Order;
use Auth;
use Carbon\Carbon;

/**
 * 店舗に関するメソッド
 *
 * Class ShopService
 * @package App\Service
 */
class ShopService
{
    /**
     * Shopインスタンス
     *
     * @var Shop
     */
    private $Shop;

    /**
     * 伝票インスタンス
     */
    private $slip;

    /**
     * オーダーインスタンス
     */
    private $order;

    /**
     * コンストラクター
     *
     * Attendance $attendance
     * @param Shop $shop
     * @param Slip $slip
     * @param Order $order
     */
    public function __construct(Shop $shop, Slip $slip, Order $order)
    {
        $this->shop = $shop;
        $this->slip = $slip;
        $this->order = $order;
    }
    
    /**
     * ログイン中の店舗情報の取得
     */
    public function fetchByShopId()
    {
        return $this->shop->where('id', Auth::id())->get();
    }

    /**
     * 来店中のユーザーの取得
     */
    public function visitUsers()
    {
        $shop = $this->shop->where('id', Auth::id())->first();
        $startTime = new Carbon($shop->start_time);
        $endTime = new Carbon('tomorrow'.$shop->end_time);

        return $this->slip->where('shop_id', Auth::id())
            ->where('is_visit', true)->whereBetween('date', [$startTime, $endTime])->get();
    }

    /**
     * 店舗の当日の伝票を取得
     */
    // public function todaySlips()
    // {
    //     $d = Carbon::now()->format('Y-m-d');
    //     return $this->slip->where('shop_id', Auth::id())->where('date', $d)->get();
    // }

    /**
     * 当日の店舗のオーダーを取得
     */
    public function fetchTodayOrders()
    {
        $shop = $this->shop->where('id', Auth::id())->first();
        $startTime = new Carbon($shop->start_time);
        $endTime = new Carbon('tomorrow'.$shop->end_time);

        return $this->order->where('shop_id', Auth::id())
            ->whereBetween('date', [$startTime, $endTime])
            ->orderBy('user_id', 'asc')
            ->get();
    }

    /**
     * 当日の店舗の売り上げの合計を取得
     * 
     * @param $todayOrders
     * @return float
     */
    public function todayTotalAccounting($todayOrders)
    {
        $todayTotalAccounting = 0;

        foreach ($todayOrders as $todayOrder) {
            $todayTotalAccounting += $todayOrder->order_price;
        };

        return $todayTotalAccounting;
    }

    public function fetchOrderByUserId($userId)
    {
        $shop = $this->shop->where('id', Auth::id())->first();
        $startTime = new Carbon($shop->start_time);
        $endTime = new Carbon('tomorrow'.$shop->end_time);

        return $this->order->where('shop_id', Auth::id())
            ->where('user_id', $userId)
            ->whereBetween('date', [$startTime, $endTime])
            ->get();
    }

    public function todayUserTotalAccounting($orders)
    {
        $todayUserTotalAccounting = 0;

        foreach ($orders as $order) {
            $todayUserTotalAccounting += $order->order_price;
        };

        return $todayUserTotalAccounting;
    }
}
