<template>
    <div class="container-form">
        <div class="form__container">
            <div class="text-center">
                <img src="/img/logo.jpg" class="brand-logo mb-3" alt="Logo ShoeStore">
            </div>
            <h2 class="mb-3 text-uppercase text-primary text-center">Đăng Nhập</h2>
            <form @submit.prevent="submitLogin">
                <div class="mb-3">
                    <input type="email" v-model="user.email" class="form-control" placeholder="Email">
                    <p class="text-danger" v-if="errors.email">
                        {{ Array.isArray(errors.email) ? errors.email[0] : errors.email }}
                    </p>
                </div>
                <div class="mb-3">
                    <input type="password" v-model="user.password" class="form-control" placeholder="Mật khẩu">
                    <p class="text-danger" v-if="errors.email">
                        {{ Array.isArray(errors.email) ? errors.email[0] : errors.email }}
                    </p>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                <div class="mt-3 text-center">
                    <router-link to="/doi-mk" class="text-primary">Đổi mật khẩu?</router-link>
                </div>
                <div class="mt-2 text-center">
                    <span>Chưa có tài khoản? <router-link to="/dang-ky" class="text-primary">Đăng
                            ký</router-link></span>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
import { urlApi } from '../../../components/store';
export default {
    setup() {
        const message = ref('');
        const errors = ref({});
        const loggedInUser = ref(null);
        const user = ref({
            email: '',
            password: ''
        });
        const submitLogin = () => {
            //Check dữ liệu phí frontend
            errors.value = {};
            message.value = '';
            // Kiểm tra email
            if (!user.value.email.trim()) {
                errors.value.email = 'Trường địa chỉ email không được để trống.';
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(user.value.email)) {
                errors.value.email = 'Email bạn nhập vào không hợp lệ.';
            }

            if (!user.value.password.trim()) {
                errors.value.password = 'Trường mật khẩu không được để trống.';
            }
            if (Object.keys(errors.value).length > 0) {
                return;
            }
            //Gọi api để check đăng nhập
            login(user.value);
        }
        //Viết hàm kiểm tra đăng nhập trên server
        const login = async (user) => {
            try {
                const response = await axios.post(`${urlApi}/login`, user);
                loggedInUser.value = response.data.user;
                // Reset form
                user.email = '';
                user.password = '';
            } catch (error) {
                if (error.response) {
                    errors.value = error.response.data.errors || {};
                    message.value = error.response.data.message;
                }
            }
        };
        return {
            submitLogin, user, errors, message, loggedInUser
        }
    }
}
</script>