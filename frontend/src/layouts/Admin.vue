<template>
    <div v-if="isLogin && isLogin.role == 1">
        <header>
            <TheHeaderAdmin></TheHeaderAdmin>
        </header>
        <router-view></router-view>
    </div>
    <div v-else>
        <p class="alert alert-warning text-center">Bạn không có quyền vào đây!</p>
        <router-link to="/">Quay lại</router-link>
    </div>
</template>
<script>
import { inject, onMounted } from 'vue';
import TheHeaderAdmin from '../components/TheHeaderAdmin.vue';
export default {
    components: {
        TheHeaderAdmin
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