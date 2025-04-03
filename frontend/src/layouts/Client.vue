<template>
    <header v-if="!$route.meta.hideHeader">
        <TheHeader></TheHeader>
    </header>
    <router-view></router-view>
    <footer v-if="!$route.meta.hideFooter">
        <TheFooter></TheFooter>
    </footer>
</template>
<script>
import { inject } from 'vue';
import TheHeader from '../components/TheHeader.vue';
import TheFooter from '../components/TheFooter.vue';
export default {
    components: {
        TheHeader,
        TheFooter
    },
    setup() {
        const isLogin = inject('isLogin');
        return {
            isLogin
        }
    }
}
</script>