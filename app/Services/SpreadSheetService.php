<?php
// strictモードの有効化
declare(strict_types=1);

namespace App\Services;

/**
 * スプレッドシート関連をまとめるクラス
 *
 */
class SpreadSheetService {

    /**
     * スプレッドシートから取得したデータをデータベースに保存する処理
     *
     * ※ テーブルの全データを削除して、スプレッドシートのデータをインサートする ※
     *
     */
    public static function insertDatabase(string $sheet_name ,array $values) {

        $class_name = 'App\Models\\'.$sheet_name;
        // テーブルのデータを一度全削除する
        $class_name::truncate();

        // インサートする処理内容はDatabaseServiceクラスに入っている
        DatabaseService::insertData($class_name ,$values);
    }

    /**
     * Google_cloud_Platform(GCP)のクライアントを作成するfunction
     *
     * @return \Google_Client
     */
    public static function getGoogleClient() :\Google_Client {

        $client = new \Google_Client();

        // storage/app/jsonファイルにGCPからダウンロードしたキーを保存
        $key_file = storage_path('app/json/credentials.json');

        // setAuthConfig=(認証構成)
        $client->setAuthConfig($key_file);

        // Gドライブ・スプレットシートの範囲（=スコープ）を指定
        $client->setScopes([
            \Google\Service\Drive::DRIVE, // Gドライブ
            \Google\Service\Sheets::SPREADSHEETS // スプレットシート
        ]);

        return $client;
    }

    /**
     * Gドライブの中のフォルダからスプレットシートのリストを取得する
     * フォルダ内にあるファイル（=リスト）
     *
     * @param \Google_Client $client
     * @param string $folder_id
     * @return \Google\Service\Drive\FileList
     */
    public static function getSpreadSheetFiles(\Google_Client $client,string $folder_id) :\Google\Service\Drive\FileList {

        // Gドライブのインスタンスを実体化
        $drive_service_instance = new \Google\Service\Drive($client);

        // リスト化（ファイルを取得）
        $list = $drive_service_instance->files->listFiles([
            'q' => "'$folder_id' in parents and trashed = false",
        ]);

        return $list;
    }

    /**
     * スプレットシートデータを取得する
     *
     * @param \Google_Client $client
     * @param integer $sheet_id
     * @return \Google\Service\Sheets\ValueRange
     */
    public static function getSpreadSheetValues(\Google_Client $client,string $sheet_id) :\Google\Service\Sheets\ValueRange {

        // スプレットシートのインスタンスを実体化
        $sheets_service_instance = new \Google\Service\Sheets($client);

        // スプレットシートのidとシート名を取得
        $spread_sheets = $sheets_service_instance->spreadsheets->get($sheet_id);
        $sheet_title = $spread_sheets->getSheets()[0]->getProperties()->getTitle();

        // シート内の全データを取得
        $all_data = $sheets_service_instance->spreadsheets_values->get($sheet_id, $sheet_title);

        return $all_data;

    }





}
