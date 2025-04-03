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
import { inject, onMounted } from 'vue';
import TheHeader from '../components/TheHeader.vue';
import TheFooter from '../components/TheFooter.vue';
export default {
    components: {
        TheHeader,
        TheFooter
    },
    emits: ["success-login"],
    setup() {
        const isLogin = inject('isLogin');
        onMounted(() => {
            const savedLoginData = localStorage.getItem('user');
            if (savedLoginData) {
                isLogin.value = JSON.parse(savedLoginData);
            }
        });
        return {
            isLogin
        }
    }
}
</script>