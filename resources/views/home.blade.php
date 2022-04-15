
{{-- 継承ビュー --}}
@extends('master')

{{-- タイトル --}}
@section('title','絵本の世界へようこそ')

{{--トップページ ( 共通部分:親ファイル → master.blade.php ) --}}
@section('content')

<div class="top_title_images">
    <h1>絵本の世界へようこそ</h1>
    <p>- Picture Library -</p>
</div>
<div class="top_new_arrivals_books">
    <div class="top_title">
        <h2>新着絵本</h2>
        <p>一覧</p>
    </div>
    <div class="top_new_arrivals_book">
        <div class="top_new_arrivals_book_details">
            @foreach ($books as $book )
                <img src="{{ $book->image_url }}" alt="">
                <ul>
                    <li>{{ $book->title }}</li>
                    <li>{{ $book->writer }}</li>
                    <li>{{ $book->target_age }}</li>
                </ul>
            @endforeach
        </div>
    </div>
    {{-- <div class="top_new_arrivals_book">
        <div class="top_new_arrivals_book_details">
            <img src="/images/guru.jpg" alt="">
            <ul>
                <li>絵本名：</li>
                <li>作家：</li>
                <li>対象年齢：</li>
            </ul>
        </div>
        <div class="top_new_image">
            <img src="/images/kingyo.jpg" alt="">
            <ul>
                <li>絵本名：</li>
                <li>作家：</li>
                <li>対象年齢：</li>
            </ul>
        </div>
        <div class="top_new_image">
            <img src="/images/osikko.jpg" alt="">
            <ul>
                <li>絵本名：</li>
                <li>作家：</li>
                <li>対象年齢：</li>
            </ul>
        </div>
    </div>
</div> --}}
<div class="top_special_features">
    <div class="top_title">
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
</div>
<div class="top_ages">
    <div class="top_title">
        <h2>年齢別</h2>
        <p>全年齢</p>
    </div>
    <div class="top_age">
        @foreach ($grouped_books_by_target_age as $target_age => $books)
            <ul>
                <li>{{ $target_age }}</li>
            </ul>
        @endforeach
    </div>
    {{-- <div class="top_age">
        <ul>
            <li>0歳～</li>
            <li>1歳～</li>
            <li>2歳～</li>
            <li>3歳～</li>
            <li>4歳～</li>
            <li>5歳～</li>
            <li>6歳～</li>
            <li>一覧</li>
            <li>おすすめ</li>
        </ul>
    </div> --}}
</div>
<div class="top_sales">
    <div class="top_title">
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
