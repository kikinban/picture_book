
{{-- 継承ビュー --}}
@extends('master')

{{-- タイトル --}}
@section('title','絵本 - 詳細・購入 -')

{{-- cssファイル読み込み --}}
@push('show_css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush

{{-- 絵本詳細ページ ( 共通部分:親ファイル → master.blade.php ) --}}
@section('content')

    <div class="book_contents">
        <div class="book_title">
            <img src="/images/book_icon.png" alt="">
            <h1>{{ $book->book_title }}</h1>
        </div>
        <div class="book_image">
            {!! $book->book_image_url !!}
        </div>
        <div class="book_details">
            <ul class="book_ul_title">
                <li>著者</li>
                <li>出版</li>
                <li>年齢</li>
                <li>ページ数</li>
            </ul>
            <ul class="book_ul_span">
                <li>:</li>
                <li>:</li>
                <li>:</li>
                <li>:</li>
            </ul>
            <ul class="book_ul_content">
                <li>{{ $book->book_writer }}</li>
                <li>{{ $book->book_the_publisher }}</li>
                <li>{{ $book->book_target_age }}歳～</li>
                <li>{{ $book->book_page_number }}</li>
            </ul>
        </div>
        <div class="book_show_buttons">
            <a class="show_button_left" href="{{ $book->book_amazon_link }}">
            Amazon
            </a>

            <button class="show_button_right">レビュー ?件</button>
        </div>
        <div class="book_introductions">
            <h2>作品紹介</h2>
            <p>{{ $book->book_description }}</p>
        </div>
        <div class="book_review">
            <h2>レビュー(みんな声)</h2>
        </div>
    </div>
@endsection
