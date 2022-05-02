<?php
// strictモードの有効化
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\SpreadSheet;
use Illuminate\Support\Facades\DB;
use \Google\Service\Sheets;
use App\Services\SpreadSheetService;

class SpreadSheetController extends Controller
{

    /**
     * スプレッドシート関連を格納している関数(store=格納)
     * @return void
     */
    public function store(){

        // Gドライブ内のマスターデータを格納しているフォルダーID（=master_dataフォルダー）
        $master_folder_id = '1YgHdDrGER8Rduf96xQG7d-z_9v56abnI';

        // GCPのクライアント情報
        $client = SpreadSheetService::getGoogleClient();

        // master_dataフォルダー直下のファイルを全て取得
        $spread_sheet_files = SpreadSheetService::getSpreadSheetFiles($client, $master_folder_id);

        foreach ($spread_sheet_files->getFiles() as $file) {
            // スプレッドシートのid(=url)
            $sheet_id = $file->getId();
            // スプレッドシードのファイル名（これがデータベースのテーブル名と紐づく）
            $sheet_name = $file->getName();

            // ファイルをリスト化
            $spread_sheet_values = SpreadSheetService::getSpreadSheetValues($client, $sheet_id);
            // 配列として取得
            $values = $spread_sheet_values->getValues();

            // データベースにインサート
            SpreadSheetService::insertDatabase($sheet_name, $values);

        }

        return response()->json(
            [
                "result" => 'スプレットシートの新規データを保存できました！',
            ],
            200 // HTTPステータスコード（=200 OK）
        );

    }

    public function index() {
        /**
         * booksテーブルのレコードを取得する
         */
        $books = DB::table('books')->get();

        return view('index',[
            'data' => $books
        ]);
    }
}
