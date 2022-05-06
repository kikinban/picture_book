require("./bootstrap");

// コンポーネント登録
// InsertComponent.vueファイル
import InsertComponent from './components/InsertComponent'

const app = {
    components: {
        InsertComponent
    }
};

Vue.createApp(app).mount("#data_register");

