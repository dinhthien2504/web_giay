<template>
    <div v-if="!isLogin" class="container-form">
        <div class="form__container">
            <div class="text-center">
                <img src="/img/logo.jpg" class="brand-logo mb-3" alt="Logo ShoeStore">
            </div>
            <h2 class="mb-3 text-uppercase text-primary text-center">Đăng Nhập</h2>
            <p v-if="message" class="alert alert-danger">{{ message }}</p>
            <form @submit.prevent="submitLogin">
                <div class="mb-3">
                    <input type="email" v-model="user.email" class="form-control" placeholder="Email">
                    <p class="text-danger" v-if="errors.email">
                        {{ Array.isArray(errors.email) ? errors.email[0] : errors.email }}
                    </p>
                </div>
                <div class="mb-3">
                    <input type="password" v-model="user.password" class="form-control" placeholder="Mật khẩu">
                    <p class="text-danger" v-if="errors.password">
                        {{ Array.isArray(errors.password) ? errors.password[0] : errors.password }}
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
