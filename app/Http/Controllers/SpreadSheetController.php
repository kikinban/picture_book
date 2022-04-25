<?php
// strictモードの有効化
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

        $spread_sheet_values = SpreadSheet::getSpreadSheetValues($sheet_id,$range);

        $values = $spread_sheet_values->getValues();

        Book::insertData($values);

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
