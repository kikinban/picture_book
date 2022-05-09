

<template>
    <div id="fullscreen" v-show="show">
        <img src="/images/loader.gif">
    </div>
</template>

<script>
    export default {
        props: {
            text: {
                default: 'ロード中...',
                type: String
            },
            show: {
                default: false,
                type: Boolean
            }
        }
    }
</script>