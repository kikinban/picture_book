
// admin/dashboard.blade.phpと連携


// ビュー
<template>
    <loading-component :show="show" />
    <button type="button" id="insert_button_picture_book" @click="spreadSheetsCallApi">絵本 登録</button>
    <button type="button" id="insert_button_special_feature" @click="spreadSheetsCallApi">特集 登録</button>
</template>

// 処理内容
<script>


    // Vue.jsのdefineComponent関数を呼び出し
    import { defineComponent } from 'vue';

    // ローディング画面のcomponentを呼び出し
    import LoadingComponent from './LoadingComponent';

    // 関数を呼び出し、propsとdataを渡す
    export default defineComponent({
        components: {
            LoadingComponent
        },

        // Laravelのurlパスを値として受け取る
        props:["url"],

        data() {
            return {
                show: false,
            };
        },

        // 関数
        methods: {

            // スプレッドシートのAPIリクエストする関数
            spreadSheetsCallApi() {

                console.log("開始");

                // ローディング画面表示
                this.show = true;


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

                    // ローディング画面表示なし
                    this.show = false;

                }

                // 呼び出し
                update_master_data();

                console.log("終了");
            }
        },

    })
</script>
