<?php

namespace App\Service\Shop;

use App\Shop;
use App\Slip;
use App\Order;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    /**
     * 当日の個人のオーダーの取得
     * 
     * @param $userId
     */
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

    /**
     * 当日の個人の会計の合計の計算
     * 
     * @param $orders
     * @return float
     */
    public function todayUserTotalAccounting($orders)
    {
        $todayUserTotalAccounting = 0;

        foreach ($orders as $order) {
            $todayUserTotalAccounting += $order->order_price;
        };

        return $todayUserTotalAccounting;
    }

    /**
     * 日報用の当日の個人の会計の合計を一覧で取得
     */
    public function slipTodayUserTotalAccounting()
    {
        return DB::table('orders')
            ->select(DB::raw('user_id ,sum(order_price) as order_price'))
            ->groupBy('user_id')
            ->get();
    }

    public function registerAccounting($id, $userPrice)
    {
        $this->slip->find($id)->update([
            'end_time' => Carbon::now(),
            'is_visit' => false,
            'accounting' => $userPrice,
        ]);
    }
}
