

{{-- (管理者) ダッシュボード --}}
<x-admin-layout>
    <div class="admin_dashboard_main">

        {{-- 左側リストボタン --}}
        <div class="admin_dashboard_left_selections">
            <ul>
                <li>新着絵本</li>
                <li>特集絵本</li>
                <li>レビュー</li>
                <li>購入履歴</li>
                <li>発送履歴</li>
                <li>お問い合わせ</li>
            </ul>
        </div>

        {{-- メインボタン --}}
        <div class="admin_dashboard_main_selections">
            <ul>
                <li>
                    <a href="{{ url('/store') }}">データ登録</a></li>
                <li>購入履歴データ</li>
                <li>お問い合わせ</li>
                <li>ユーザーデータ</li>
            </ul>
        </div>
    </div>
</x-admin-layout>
