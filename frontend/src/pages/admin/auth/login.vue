<template>
    <div v-if="!isLogin" class="container__form-login">
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
    <div v-else class="bg-light d-flex align-items-center justify-content-center text-center" style="height: 85vh;">
        <p class="alert alert-success">Xin chào: {{ isLogin.name }}
        <p>
            Chúc bạn trải nghiệm trang web vui vẻ nhé!
        </p>
        </p>
    </div>
</template>

<script>
import axios from 'axios';
import { urlApi } from '../../../components/store';

export default {
    emits: ['success-login'], // Khai báo sự kiện emit
    data() {
        return {
            message: '',
            errors: {},
            user: {
                email: '',
                password: ''
            },
            isLogin: JSON.parse(localStorage.getItem('user')) || null
        };
    },
    methods: {
        async submitLogin() {
            this.errors = {};
            this.message = '';

            if (!this.user.email.trim()) {
                this.errors.email = 'Trường địa chỉ email không được để trống.';
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.user.email)) {
                this.errors.email = 'Email bạn nhập vào không hợp lệ.';
            }

            if (!this.user.password.trim()) {
                this.errors.password = 'Trường mật khẩu không được để trống.';
            }

            if (Object.keys(this.errors).length > 0) {
                return;
            }

            try {
                const response = await axios.post(`${urlApi}/login`, this.user);
                if (response.status === 200) {
                    //Kiểm tra trạng thái tài khoản
                    if (response.data.user.status == 1) {
                        this.message = "Tài khoản bạn đã bị khóa!";
                        return;
                    }
                    localStorage.setItem('auth_token', response.data.token);
                    localStorage.setItem('user', JSON.stringify(response.data.user));

                    const role = response.data.role === 0 ? 'home' : 'admin-dashboard';
                    this.$router.push({ name: role });

                    this.$emit('success-login', response.data.user);
                }
            } catch (error) {
                if (error.response) {
                    this.errors = error.response.data.errors || {};
                    this.message = error.response.data.message;
                }
            }
        }
    }
};
</script>