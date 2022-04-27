<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * * データベースに接続して処理できるモデル
 * （Eloquent）を利用する
 */
class SpecialFeature extends Model
{
    // 更新していいカラムのホワイトリスト
    // fillable = 書き込めるという意味
    protected $fillable = [
        'id',
        'special_feature_title',
        'special_feature_text',
        'special_feature_image',
        'special_feature_start_date',
        'created_at',
        'updated_at',
    ];
}
