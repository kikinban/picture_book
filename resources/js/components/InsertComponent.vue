
// admin/dashboard.blade.phpと連携


// ビュー
<template>
    <p>データ登録</p>
    <button type="button" class="insert_button" @click="spreadSheetsCallApi" :disabled="isProcessing()">登録</button>
</template>

// 処理内容
<script>

    // Vue.jsのdefineComponent関数を呼び出し
    import { defineComponent } from 'vue';

    // screen.js呼び出して、スクリーンロック処理を利用
    import { screenLook } from '../mixins/processing';

    // 関数を呼び出し、propsとdataを渡す
    export default defineComponent({

        // Laravelのurlパスを値として受け取る
        props:["url"],
        // screenLook変数呼び出し
        mixins:[screenLook],
        // 関数
        methods: {

            // スプレッドシートのAPIリクエストする関数
            spreadSheetsCallApi() {

                console.log("開始");

                // 画面ブロック開始
                this.startProcessing();

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

                    // 画面ブロック解除
                    this.endProcessing();
                }

                // 呼び出し
                update_master_data();

                console.log("終了");
            }
        }
    })
</script>
