<?php
declare(strict_types=1);

namespace App\Models;


// 関数をわける
// 1.スプレッドシートのデータを取得するFunction
// 2.mysqlに接続するfunction
// 3.データを比較するfunction


// 汎用性を高める（booksテーブルの処理になっている）


class SpreadSheet
{
    /**
     * スプレッドシートのデータを取得するFunction
     *
     * @param string $sheet_id
     * @param string $range
     * @return void
     */
    public static function spread_sheet_data(string $sheet_id,string $range)
    {
        // スプレッドシートを操作するGoogleClientインスタンスの生成（後述のファンクション）
        $sheets = self::instance();

        $response = $sheets->spreadsheets_values->get($sheet_id, $range);

        // （変数spread_sheet_valuesに変数responseの中にあるgetValues()を代入）
        $spread_sheet_values = $response->getValues();

        // fieldsの中はスプレットシートのフィールド名（先頭の行）が入っている
        $fields = $spread_sheet_values[0];

        /**
         * スプレットシートから取得したデータをDBに保存したい
         */
        $book_table_all = Book::all();

        foreach ($spread_sheet_values as $row_count => $spread_sheet_row) {

            // インデックスが0の場合はフィールド名が入っている為、ループから抜ける
            if ($row_count === 0) {
                continue;
            }

            // booksテーブルのidを取得
            foreach ($book_table_all as $book) {
                $book_id = $book->id;

                // スプレットシートのidとbookテーブルのidを比較する
                if ((int)$spread_sheet_row[0] === $book_id) {
                    continue 2;
                }
            }

            // インサートする為の変数
            $insert_row = [];

            // fieldsの中はスプレットシートのフィールド名（先頭の行）が入っている
            // それをforeachでインデックスをキーにもつ、値を取り出す
            // $indexが0の時は、$fieldがidというフィールド名になる
            foreach ($fields as $index => $field) {
                // $spread_sheet_rowは$spread_sheet_valuesの一つずつ取り出した行
                // $spread_sheet_rowのキー名を$indexとする0=1,1=だるまさんが
                // $spread_sheet_rowのインデックスはfieldsのインデックスと一緒の並びだからイコール（=共通）
                // だから[0]とかの指定ではなく、変数にしてforeach文で使えるようにする
                // $insert_value = インデックスに関連づいている値が入っている
                // $spread_sheet_row[$index] = 1が入っている
                $insert_value = $spread_sheet_row[$index];
                // カラム名が欲しい
                // 空の配列$insert_rowにカラム名$fieldを指定し、$insert_valueの値を入れる
                // [id => 1]のように、順番に入っていく
                $insert_row[$field] = $insert_value;
            }

            // インサートの処理
            Book::create($insert_row);
        }
    }


    /**
     * スプレッドシート操作用のインスタンスを生成するFunction
     *
     * @return \Google\Service\Sheets
     */
    public static function instance() : \Google\Service\Sheets
    {
        // storage/app/json フォルダに GCP からダウンロードした JSON ファイルを設置する
        $credentials_path = storage_path('app/json/credentials.json');
        $client = new \Google_Client();
        $client->setScopes([\Google\Service\Sheets::SPREADSHEETS]);
        $client->setAuthConfig($credentials_path);
        return new \Google\Service\Sheets($client);
    }

}

