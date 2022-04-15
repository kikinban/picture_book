<?php
// strictモードの有効化
declare(strict_types=1);

namespace App\Services;

use App\Models\Book;

/**
 * Book関連の処理をまとめたクラス
 */
class BookService {
    /**
     * target_ageによりBookの配列をグルーピングする。
     *
     * @param Book[] $books Bookの配列
     * @return Book[target_age][] $grouped_books target_ageによりグルーピングされたBookの配列
     */
    public function groupByTargetAge(array $books) {
        $grouped_books = [];

        // target_ageでグルーピング処理
        foreach($books as $book) {
            $target_age = $book->target_age;
            // $grouped_booksが未定義（NULL）のときに初期化する
            // if(isset($grouped_books[$target_age]) === false) {
            //     $grouped_books[$target_age] = [];
            // }

            // $grouped_booksが未定義（NULL）のときに初期化する
            // null合体代入演算子を利用したバージョン
            $grouped_books[$target_age] ??= [];
            $grouped_books[$target_age][] = $book;


        }

        return $grouped_books;


        /*
         * [
         *   new Book('だるまさん',"かがり","0","/images/guru.jpg"),
         *   new Book('だるまさん',"かがり","0","/images/guru.jpg"),
         *   new Book('いろえんぴつ',"みさ","2","/images/kingyo.jp"),
         * ]
         *
         * [0][
         *   new Book('だるまさん',"かがり","0","/images/guru.jpg"),
         *   new Book('だるまさん',"かがり","0","/images/guru.jpg"),         *
         * ]
         * [2][
         *   new Book('いろえんぴつ',"みさ","2","/images/kingyo.jp"),
         * ]
         *
         * $grouped_books[0] = [];
         * $grouped_books[2] = [];
         *
         * $grouped_books[0][] = $book;
         * $grouped_books[0][] = $book;
         * $grouped_books[2][] = $book;
         *
         * $grouped_books[2][0]
         */

    }
}
