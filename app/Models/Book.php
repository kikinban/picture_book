<?php
// strictモードの有効化
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * データベースに接続して処理できるモデル
 * （Eloquent）を利用する
 */
class Book extends Model
{
    use HasFactory;

    // 更新していいカラムのホワイトリスト
    // fillable = 書き込めるという意味
    protected $fillable = [
        'id',
        'book_title',
        'book_writer',
        'book_target_age',
        'book_image_url',
        'book_page_number',
        'book_description',
        'created_at',
        'updated_at',
    ];

}

