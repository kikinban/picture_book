<?php
// strictモードの有効化
declare(strict_types=1);

namespace App\Models;

// クライアントの作成
// スプレットシートを呼び出す
// 処理をわける

class SpreadSheet
{
     /**
      * スプレットシートのデータを取得するfunction
      * @param string $sheet_id
      * @param string $range
      * @return \Google\Service\Sheets\ValueRange
      */
    public static function getSpreadSheetValues(string $sheet_id,string $range) :\Google\Service\Sheets\ValueRange {

        // スプレッドシートを操作するGoogleClientインスタンスの生成（後述のファンクション）
        $sheets = self::instance();

        $response = $sheets->spreadsheets_values->get($sheet_id, $range);

        return $response;
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

