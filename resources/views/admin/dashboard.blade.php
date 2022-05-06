

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
                <li id="data_register">
                    <insert-component :url='{{ json_encode(url('/store')) }}' />
                </li>
                <li>購入履歴データ</li>
                <li>お問い合わせ</li>
                <li>ユーザーデータ</li>
                <li id="test">APIテスト</li>
            </ul>
        </div>
    </div>
        <script src="{{ asset('js/dashboard.js') }}"></script>

</x-admin-layout>

{{-- <script>
    //スプレッドシートのAPIリクエストをする関数
    // asyncで非同期通信
    async function sheetsCallApi() {
        //PHPでurlを埋め込み(レスポンス)
        var url = "{{ url('/store') }}"
        //fetchで同期APIリクエスト
        fetch(url)
        //then 通信が終わったらjsonをパース(=文法に従って分析)する
        .then((response) => {
            //次のthenの入力になる
            return response.json();
        })
        //画面にalert表示する
        .then((data) => {
            notice(data.result)
        })
    };

    // 引数のテキストを画面にアラート表示する
    async function notice(msg) {
        alert(msg);
    }

    //ボタンにcallAPI関数を登録する
    let button = document.getElementById('test');
    button.onclick = sheetsCallApi;
</script> --}}

{{-- <script>
    // スプレッドシートのAPIリクエストする関数
    // asyncで非同期通信
    async function spredSheetsCallApi() {
        let sheet_url = "{{ url('/store') }}";
        const data = await fetch(sheet_url);
        const data_json = await data.json();

        // アラート
        alert(data_json.result);
    }

    // データ登録ボタンにspredSheetsCallApi関数を登録する
    document.getElementById("data_register").onclick = function() {
        spredSheetsCallApi();
    }


</script> --}}

{{-- <script>
    new Vue({
    el: '#data_register',
    data() {
        return {
        link: "{{ url('/store') }}"
        }
    }
    });
</script> --}}

