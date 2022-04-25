<?php
// strictモードの有効化
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Services\BookService;

class TopController extends Controller
{
    /**
     * 絵本の詳細function
     * bookDetail = 絵本の詳細
     *
     * @return void
     */
    public function bookDetail() {

        // booksテーブルの全データを取得する
        $books = Book::all();

        // booksテーブルのidを降順で取得（新着絵本データ）
        $new_arrival_books = Book::orderByDesc('id')->get();

        // 0~6歳までの年齢を設定
        $book_target_ages = [0, 1, 2, 3, 4, 5, 6];


        return view('top',[

            // booksテーブル全データ
            'books' => $books,

            // 新着絵本データ
            'new_arrival_books' => $new_arrival_books,

            // 年齢データ
            'book_target_ages' => $book_target_ages
        ]);
    }
}
