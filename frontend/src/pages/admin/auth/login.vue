<template>
    <div class="container__form-login">
        <!-- Form Đăng nhập -->
        <div id="loginForm" class="container__form-content">
            <h2 class="text-center fs-4">Đăng Nhập Admin</h2>
            <p v-if="message" class="alert alert-warning">{{ message }}</p>
            <form @submit.prevent="submitLogin">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" v-model="user.email" class="form-control" id="email">
                    <p class="text-danger" v-if="errors.email">
                        {{ Array.isArray(errors.email) ? errors.email[0] : errors.email }}
                    </p>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" v-model="user.password" class="form-control" id="password">
                    <p class="text-danger" v-if="errors.password">
                        {{ Array.isArray(errors.password) ? errors.password[0] : errors.password }}
                    </p>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
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