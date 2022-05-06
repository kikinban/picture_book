require("../bootstrap");

// スクリーンロックする処理
// processing(=処理)

export const screenLook = {
    data() {
        return {
            processing: false
        }
    },
    methods: {
        startProcessing() {
            this.processing = true
        },
        endProcessing() {
            this.processing = false
        },
        isProcessing() {
            return this.processing
        }
    }
}



