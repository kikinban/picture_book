<?php
// strictモードの有効化
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Services\BookService;

class HomeController extends Controller
{
    public function bookDetail() {
        $books = [
            new Book('だるまさん',"かがり",0,"/images/guru.jpg"),
            new Book('いろえんぴつ',"みさ",2,"/images/kingyo.jp"),
        ];

        $book_service = new BookService();
        $grouped_books = $book_service->groupByTargetAge($books);

        return view('home',[

            'books' => $books,
            'grouped_books_by_target_age' => $grouped_books

        ]);
    }
}
