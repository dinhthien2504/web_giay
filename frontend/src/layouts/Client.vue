<template>
    <header v-if="!$route.meta.hideHeader">
        <TheHeader></TheHeader>
    </header>
    <router-view @success-login="handleLogin"></router-view>
    <footer v-if="!$route.meta.hideFooter">
        <TheFooter></TheFooter>
    </footer>
</template>
<script>
import { ref, provide, onMounted } from 'vue';
import TheHeader from '../components/TheHeader.vue';
import TheFooter from '../components/TheFooter.vue';
export default {
    components: {
        TheHeader,
        TheFooter
    },
    setup() {
        const isLogin = ref(null);
        const handleLogin = (data) => {
            console.log(">>Đã đăng nhập thành công: ", data);
            isLogin.value = data;
        }
        //Nếu trước đã đăng nhập thì lấy lại thông tin
        onMounted(() => {
            const savedLoginData = localStorage.getItem('user');
            if (savedLoginData) {
                isLogin.value = JSON.parse(savedLoginData);
            }
        });
        provide('isLogin', isLogin);

        return {
            handleLogin
        }
    }
}
</script>