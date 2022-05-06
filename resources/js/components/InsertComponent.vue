
// admin/dashboard.blade.phpと連携


// ビュー
<template>
    <p>データ登録</p>
    <button type="button" class="insert_button" :click="spreadSheetsCallApi">登録</button>
</template>

// 処理内容
<script>
    // Vue.jsのdefineComponent関数を作成
    import { defineComponent } from 'vue'

    // 関数を呼び出し、propsとdataを渡す
    export default defineComponent({

        // Laravelのurlパスを値として受け取る
        props:["url"],
        methods: {

            // スプレッドシートのAPIリクエストする関数
            spreadSheetsCallApi() {

                console.log("開始");
                // 取得したurlをsheet_urlに代入
                let sheet_url = this.url;

                // 非同期通信の処理(async=非同期)
                const update_master_data = async () => {
                    // レスポンスの値を代入
                    const data = await fetch(sheet_url);
                    console.log(data);
                    // 値をjsonに変換し、代入
                    const data_json = await data.json();
                    console.log(data_json);
                    alert(data_json.result);
                }

                // 呼び出し
                update_master_data();

                console.log("終了");
            }
        }

    })
</script>
