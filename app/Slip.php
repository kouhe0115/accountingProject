<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    /**
     * boolean 型へ変換
     *
     * @var array
     */
    protected $casts = [
        'is_visit' => 'boolean',
    ];

    /**
     * timestampを使用しない
     */
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'shop_id',
        'start_time',
        'end_time',
        'accounting',
        'is_visit'
    ];

    protected $dates = [
        'start_time',
        'end_time',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
