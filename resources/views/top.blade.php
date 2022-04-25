
{{-- 継承ビュー --}}
@extends('master')

{{-- タイトル --}}
@section('title','絵本の世界へようこそ')

{{--トップページ ( 共通部分:親ファイル → master.blade.php ) --}}
@section('content')

{{-- トップページタイトル --}}
<div class="top_title_images">
    <h1>絵本の世界へようこそ</h1>
    <p>- Picture Library -</p>
</div>

{{-- 新着絵本 --}}
<div class="top_new_arrivals_books">
    <div class="top_heading_title">
        <h2>新着絵本</h2>
        <p>一覧</p>
    </div>
    <div class="top_new_arrivals_book">
        <div class="top_new_arrivals_book_details">
            @foreach ($new_arrival_books as $new_arrival_book)
                <div class="top_new_arrivals_book_detail">
                    <img src="{{ $new_arrival_book->book_image_url }}" alt="">
                    <ul>
                        <li>{{ $new_arrival_book->book_title }}</li>
                        <li>{{ $new_arrival_book->book_writer }}</li>
                        <li>{{ $new_arrival_book->book_target_age }}</li>
                        <li>{{ $new_arrival_book->book_page_number }}</li>
                        <li>{{ $new_arrival_book->book_description }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- 特集 --}}
<div class="top_special_features">

</div>
{{-- <div class="top_special_features">
    <div class="top_heading_title">
        <h2>特集</h2>
        <p>一覧</p>
    </div>
    <div class="top_special_feature">
        <div class="top_special_feature_image">
            <ul>
                <li>特集名：</li>
                <li>詳細コメント</li>
            </ul>
        </div>
        <div class="top_special_feature_image">
            <ul>
                <li>特集名：</li>
                <li>詳細コメント</li>
            </ul>
        </div>
    </div>
</div> --}}

{{-- 年齢別絵本 --}}
<div class="top_ages">
    <div class="top_heading_title">
        <h2>年齢別</h2>
        <p>全年齢</p>
    </div>
    <div class="top_age">
        <ul>

            @foreach ($book_target_ages as $target_age)
                <li>{{ $target_age }}</li>
            @endforeach
        </ul>
    </div>
</div>

{{-- 絵本販売 --}}
<div class="top_sales">
    <div class="top_heading_title">
        <h2>絵本販売</h2>
        <p>一覧</p>
    </div>
    <div>
        <h3>絵本をご購入の方</h3>
        <ul>
            <li>配送料：</li>
            <li>発送：</li>
            <li>お支払い方法：</li>
            <li></li>
        </ul>
    </div>
</div>

@endsection
