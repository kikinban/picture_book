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
            // null合体代入演算子を利用したバージョン
            $grouped_books[$target_age] ??= [];
            $grouped_books[$target_age][] = $book;

        }

        return $grouped_books;

    }

    // トップページに特集ページを表示する

}
