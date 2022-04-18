<?php
// strictモードの有効化
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Services\BookService;

class TopController extends Controller
{
    public function bookDetail() {
        $books = [
            new Book('だるまさん',"かがり",0,"/images/guru.jpg"),
            new Book('だるまさん',"かがり",1,"/images/guru.jpg"),
            new Book('いろえんぴつ',"みさ",2,"/images/kingyo.jpg"),
            new Book('いろえんぴつ',"みさ",4,"/images/kingyo.jpg"),
            new Book('いろえんぴつ',"みさ",5,"/images/kingyo.jpg"),
            new Book('いろえんぴつ',"みさ",6,"/images/kingyo.jpg"),
        ];

        $book_service = new BookService();
        $grouped_books = $book_service->groupByTargetAge($books);

        return view('top',[

            'books' => $books,
            'grouped_books_by_target_age' => $grouped_books

        ]);
    }
}
