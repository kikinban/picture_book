<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\SpreadSheet;
use Illuminate\Support\Facades\DB;

class SpreadSheetController extends Controller
{

    /**
     *
     * @return void
     */
    public function store(){
        // スプレッドシートに格納するテストデータです
        $insert_data = [
            'hoge' => 'test text',
            'huga' => 12345,
            'foo'  => true
        ];
        $sheet_id = '16--Q_YBC3HG8dBuGM58g34UgYTdPuDYafivApOCcp8U';
        $range = 'A1:G';

        SpreadSheet::insert_spread_sheet($sheet_id,$range,$insert_data);

        return response('格納に成功！！', 200);
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
