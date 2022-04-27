
{{-- 継承ビュー --}}
@extends('master')

{{-- タイトル --}}
@section('title','絵本 - 詳細・購入 -')

{{-- 絵本詳細ページ ( 共通部分:親ファイル → master.blade.php ) --}}
@section('content')

<div class="book_contents">
    <div class="book_image">
        <img src="" alt="">
        <ul>
            <li>カートに入れる</li>
            <li>お気に入り</li>
            <li>レビューを見る</li>
        </ul>
    </div>
    <div>
        <h1>だるまさんが（だるまさんシリーズ）</h1>
        <ul>
            <li>作：</li>
            <li>かがくいひろし</li>
            <li>出版社：</li>
            <li>ブロンズ新社</li>
            <li>対象年齢：</li>
            <li>0歳～</li>
            <li>ページ数</li>
            <li>15P</li>
        </ul>
    </div>
    <div>
        <h2>作品内容</h2>
        <p>おもしろい</p>
    </div>
</div>


@endsection
