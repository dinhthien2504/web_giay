<template>
  <router-view @success-login="handleLogin"></router-view>
</template>

<script>
import { ref, provide, onMounted } from 'vue';
export default {
  setup() {
    const isLogin = ref(null);
    const handleLogin = (data) => {
      console.log(">>Đã đăng nhập thành công: ", data);
      isLogin.value = data;
    }
    //Nếutrước đã đăng nhập thì lấy lại thông tin
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