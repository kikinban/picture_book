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

    /**
     * MySQLにインサートするfunction
     */
    public static function insertData(array $values) {


        // $valuesの先頭行にはフィールド名が入っている
        $fields = $values[0];

        /**
         *  データの更新とインサートを同時に出来るようにしたい
         */

        // mysqlのデータを一度全削除する
        Book::truncate();

        foreach ($values as $row_count => $row) {

            // 先頭の行はフィールドの為、読み込まない
            // つまり、ループから抜ける処理
            if ($row_count === 0) {
                continue;
            }

            // 空の配列を用意する
            $insert_row = [];
            // $fieldsはフィールド名（先頭の行）を取得している
            // $rowのインデックスと$fieldsのインデックスは同じ構造
            // その為、$rowのインデックスを$fieldsのインデックスに置き換える
            // また$fieldはフィールド名の為、配列のカラム名として入力できるようにする
            $row[0] = (int)$values[0];
            foreach ($fields as $index => $field) {
                $insert_value = $row[$index];
                $insert_row[$field] = $insert_value;
            }

            // 全データがmysqlに保存される
            Book::create($insert_row);
        }
    }

}
