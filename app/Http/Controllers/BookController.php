<?php

// strictモードの有効化
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller {

    /**
     * idを取得して、viewを紐づける(新着絵本link)
     *
     * @param [type] $id
     * @return void
     */
    public function show($id) {
        $book = Book::find($id);
        return view('books/show', compact('book'));
    }
}
