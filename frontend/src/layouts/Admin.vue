<template>
    <header>
        <TheHeaderAdmin></TheHeaderAdmin>
    </header>
    <router-view @success-login="handleLogin"></router-view>
</template>
<script>
import { ref, provide, onMounted } from 'vue';
import TheHeaderAdmin from '../components/TheHeaderAdmin.vue';
export default {
    components: {
        TheHeaderAdmin
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
        provide('isLogin', isLogin);//Truyền dữ liệu của toàn bộ trang web

        return {
            handleLogin
        }
    }
}
</script>