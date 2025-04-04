<template>
    <div v-if="isLogin && isLogin.role == 1">
        <header>
            <TheHeaderAdmin></TheHeaderAdmin>
        </header>
        <router-view @success-login="handleLogin"></router-view>
    </div>
    <div v-else>
        <p class="alert alert-warning text-center">Bạn không có quyền vào đây!</p>
        <router-link to="/">Quay lại</router-link>
    </div>
</template>
<script>
import { ref, onMounted, provide } from 'vue';
import TheHeaderAdmin from '../components/TheHeaderAdmin.vue';
export default {
    components: {
        TheHeaderAdmin
    },
    emits: ["success-login"],
    setup() {

        const isLogin = ref(null);
        // Xử lý khi nhận sự kiện đăng nhập thành công từ component con
        const handleLogin = (data) => {
            console.log(">> Đã đăng nhập thành công: ", data);
            isLogin.value = data; // Cập nhật trạng thái đăng nhập
        };
        onMounted(() => {
            const savedLoginData = localStorage.getItem('user');
            if (savedLoginData) {
                isLogin.value = JSON.parse(savedLoginData);
            }
        });
        provide('isLogin', isLogin);
        return {
            isLogin, handleLogin
        }
    }
}
</script>