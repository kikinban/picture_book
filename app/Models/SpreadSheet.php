<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 関数をわける
// pdoをベタがきしない
// コメントをいるのといらないのを分ける
// 汎用性を高める（booksテーブルの処理になっている）


class SpreadSheet extends Model
{
    use HasFactory;

    /**
     * スプレッドシート挿入用Function
     *
     * データを格納したい SpreadSheet のURLが
     * https://docs.google.com/spreadsheets/d/×××××××××××××××××××/edit#gid=0
     * である場合、××××××××××××××××××× の部分を以下に記入する
     * @param string $sheet_id
     * @param string $range
     * @param array $insert_data
     * @return void
     */
    public static function insert_spread_sheet(string $sheet_id,string $range)
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
        try {
          // データベースに接続する
            $pdo = new \PDO(
                // ホスト名、データベース名
                'mysql:host=mysql;dbname=example_app;',

                // ユーザー名
                'root',

                // パスワード
                'password'
            );

            /**
             * prepareメソッドを使用する為に行う（インサート文）
             */

            // ☆ インサート文のカラム名を指定する際に変数で指定する ☆
            // 文字列の最後一つずつにカンマ,をつけて、配列の文字列を全て連結させる
            $comma_sepalated_fields = implode(',',$fields);

            // ☆ インサート文のVALUEを指定する際に変数で指定する ☆
            // 配列の中身を[:id,:book_title, ~続く]のように文字列の
            // 先頭に":"、末尾に","を入れて変数$comma_sepalated_fields_placeholderに代入する

            // 配列の中身を初期化する
            $comma_sepalated_fields_placeholder = "";

            // 変数$fieldsをforeach文で一つずつ取り出し、文字列に:,を連結させて
            // 変数comma_sepalated_fields_placeholderに代入する
            foreach ($fields as $field) {
                $comma_sepalated_fields_placeholder .= ":".$field.",";
            }

            // 文字列の最後のカンマが不要な為、削除する
            // 第一引数に文字列が入っている変数名、第二引数には何番目か、第三引数には何文字
            // 第三引数が-(マイナス)の場合は、最後から何番目という指定になる
            $comma_sepalated_fields_placeholder = substr($comma_sepalated_fields_placeholder,0 ,-1);

            // ☆ 上記の変数をそれぞれ連結させて、インサート文の完成
            $sql = "";
            $sql .= "INSERT INTO books ($comma_sepalated_fields) ";
            $sql .= "VALUES($comma_sepalated_fields_placeholder)";

            // ☆ インサートの準備 ☆
            $statement = $pdo->prepare($sql);

            /**
             * mysqlのデータを取得して、スプレットシートの内容と比較する
             * 両方のid同士を比較して、新しいデータのみをmysqlに保存する
             */
            // booksテーブルの全レコードを取得
            $books_tables_state = $pdo->query('SELECT * FROM books');
            // booksテーブルから\PDO::FETCH_ASSOCとすることで
            // 1レコードずつ取得し、カラム名をキーとしてもつ配列に形式を変えて変数に代入する
            // fetchとは取得するという意味
            $books_tables_records = $books_tables_state->fetchAll(\PDO::FETCH_ASSOC);

            // ☆ foreach文でスプレットシートのidを取得し、booksテーブルのidと比較する処理 ☆
            // $spread_sheet_valuesはarray(5)が入っていて、その中も配列で[0]には
            // カラム名（＝フィールド名）のデータが入っている
            $loop_count = 0;
            foreach ($spread_sheet_values as $row_count => $spread_sheet_row) {

                // 一行目はフィールド情報なので、飛ばす
                // continueでループを抜ける
                if($loop_count === 0) {
                    $loop_count++;
                    continue;
                }

                // スプレットシートのid（フィールド名）が取り出す
                $spread_book_id = (int)$spread_sheet_row[0];

                // foreach文で$books_tables_recordsを一つずつ取り出して、その中のidを取得する
                foreach ($books_tables_records as $books_tables_record) {

                    // カラム名がキーだから、idを指定してidのvalueを取得
                    $book_id = $books_tables_record['id'];

                    // mysqlのidとスプレットシートのidを比較
                    if($book_id === $spread_book_id) {
                        // continue 2で2つ前のループ文を抜けることができる
                        $loop_count++;
                        continue 2;
                    }
                }

                /**
                 * インサート文のデータをセットする
                 */
                // $spread_sheet_rowをループする
                // $spread_sheet_rowのインデックス番号が列数となる
                // ので$fieldを$fieldsから取得する際に利用できる
                foreach ($spread_sheet_row as $column_count => $cell_value) {
                    //fieldを取得する
                    $field = $fields[$column_count];
                    // bindValueメソッドは変数の値をバインド（関連づける）する
                    // 第一引数にはパラメータID(=例→:id)、第二引数にはバインドする値
                    $statement->bindValue($field,$cell_value);
                }

                // SQL実行され、データが保存される
                $statement->execute();

                $loop_count++;
            }
        } finally {
            // SQLの接続を閉じる
            $pdo = null;
        }

//         // 格納する行の計算
//         $row = count($spread_sheet_values) + 1;

//         // データを整形（この順序でシートに格納される）
//         $contact = [
//             $insert_data['hoge'],
//             $insert_data['huga'],
//             $insert_data['foo'],
//         ];
//         $values = new \Google\Service\Sheets\ValueRange();

//         $values->setValues([
//             'values' => $contact
//         ]);
//         /*
//         $sheets->spreadsheets_values->append(
//             $sheet_id,
//             'A'.$row,
//             $values,
//             ["valueInputOption" => 'USER_ENTERED']
//         );
// */
//         return true;

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

