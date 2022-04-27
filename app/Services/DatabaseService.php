<?php
// strictモードの有効化
declare(strict_types=1);

namespace App\Services;

/**
 * データベース関連をまとめるクラス
 *
 */
class DatabaseService {

    /**
     * 引数に入ってきたデータをデータベースに保存する処理
     */
    public static function insertData(string $class_name ,array $values) {

        // $valuesの先頭行にはフィールド名が入っている
        $fields = $values[0];

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
            // また$fieldはフィールド名の為、配列のカラム名として入力できるようにする
            foreach ($fields as $index => $field) {
                $insert_value = $row[$index];
                $insert_row[$field] = $insert_value;
            }

            // 全データが保存される
            $class_name::create($insert_row);
        }
    }
}
