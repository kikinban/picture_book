<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\SpreadSheet;
use Illuminate\Support\Facades\DB;
use \Google\Service\Sheets;

class SpreadSheetController extends Controller
{

    /**
     *
     * @return void
     */
    public function store(){

        // スプレットシートID(laravel-booksファイル)
        $sheet_id = '16--Q_YBC3HG8dBuGM58g34UgYTdPuDYafivApOCcp8U';
        // スプレットシートの範囲指定
        $range = 'A1:G';

        // 上記のデータを引数にもつ
        SpreadSheet::spread_sheet_data($sheet_id,$range);

        return response('スプレットシートの新規データを保存できました！', 200);

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
