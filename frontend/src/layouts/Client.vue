<template>
    <div>
        <header v-if="!$route.meta.hideHeader">
            <TheHeader></TheHeader>
        </header>

        <router-view v-bind="$attrs" @success-login="handleLogin"></router-view>

        <footer v-if="!$route.meta.hideFooter">
            <TheFooter></TheFooter>
        </footer>
    </div>
</template>

<script>
import { ref, provide, onMounted } from 'vue';
import TheHeader from '../components/TheHeader.vue';
import TheFooter from '../components/TheFooter.vue';

export default {
    emits: ['success-login'], // Khai báo sự kiện emit
    components: {
        TheHeader,
        TheFooter
    },
    inheritAttrs: false,
    setup() {
        const isLogin = ref(null);

        // Xử lý khi nhận sự kiện đăng nhập thành công từ component con
        const handleLogin = (data) => {
            console.log(">> Đã đăng nhập thành công: ", data);
            isLogin.value = data; // Cập nhật trạng thái đăng nhập
        };

        // Lấy dữ liệu đăng nhập từ localStorage khi component được mount
        onMounted(() => {
            const savedLoginData = localStorage.getItem('user');
            if (savedLoginData) {
                isLogin.value = JSON.parse(savedLoginData);
            }
        });

        // Cung cấp `isLogin` cho các component con
        provide('isLogin', isLogin);

        return {
            isLogin,
            handleLogin
        };
    }
};
</script>
