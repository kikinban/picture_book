<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



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
    public static function insert_spread_sheet(string $sheet_id,string $range,array $insert_data)
    {
        // スプレッドシートを操作するGoogleClientインスタンスの生成（後述のファンクション）
        $sheets = self::instance();

        $response = $sheets->spreadsheets_values->get($sheet_id, $range);

        // （変数spread_sheet_valuesに変数responseの中にあるgetValues()を代入）
        $spread_sheet_values = $response->getValues();


        /**
         * スプレットシートから取得したデータをDBに保存したい
         */
        try {
            $pdo = new \PDO(
                // ホスト名、データベース名
                'mysql:host=mysql;dbname=example_app;',

                // ユーザー名
                'root',

                // パスワード
                'password'
            );

            //１行目はフィールドの配列
            $fields = $spread_sheet_values[0];
            $comma_sepalated_fields = implode(',',$fields);
            // $comma_sepalated_fields_colon = ":".$comma_sepalated_fields;


            // ：を文字列の先頭につけたい
            // 結果は:id, :book_title
            $comma_sepalated_fields_placeholder = "";
            foreach ($fields as $field) {
                $comma_sepalated_fields_placeholder .= ":".$field.",";
            }
            // 文字列の最後のカンマが不要な為、削除
            $comma_sepalated_fields_placeholder = substr($comma_sepalated_fields_placeholder,0 ,-1);


            // Insert文
            $sql = "";
            $sql .= "INSERT INTO books ($comma_sepalated_fields) ";
            $sql .= "VALUES($comma_sepalated_fields_placeholder)";

            // インサートの準備
            $statement = $pdo->prepare($sql);

            // インサート文（一行追加）を複数実行されるようにする
            // $spread_sheet_valuesの行を複数インサートしたい。[0],[1],[2],[3]
            // しかし[0]にはフィールド名が入っている為、そこはインサート文として取り入れないようにする
            // それ以外の行を取り入れるようにする
            // インサートの文と値のセットをループしたい
            // row_count = テーブルの行のこと
            foreach ($spread_sheet_values as $row_count => $spread_sheet_row) {

                if ($row_count === 0) {
                    //[0]の時はインサートしない（continue=ループを一回スキップする）
                    continue;
                }

                // それ以外の時はインサートする

                // $spread_sheet_rowをループする
                // $spread_sheet_rowのインデックス番号が列数となる
                // ので$fieldを$fieldsから取得する際に利用できる
                foreach ($spread_sheet_row as $column_count => $cell_value) {
                    //fieldを取得する
                    $field = $fields[$column_count];
                    $statement->bindValue($field,$cell_value);
                }

                // SQL実行
                $statement->execute();


            }

        } finally {
            // SQLの接続を閉じる
            $pdo = null;
        }




        // 格納する行の計算
        $row = count($spread_sheet_values) + 1;






        // データを整形（この順序でシートに格納される）
        $contact = [
            $insert_data['hoge'],
            $insert_data['huga'],
            $insert_data['foo'],
        ];
        $values = new \Google\Service\Sheets\ValueRange();

        $values->setValues([
            'values' => $contact
        ]);
        /*
        $sheets->spreadsheets_values->append(
            $sheet_id,
            'A'.$row,
            $values,
            ["valueInputOption" => 'USER_ENTERED']
        );
*/
        return true;
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
