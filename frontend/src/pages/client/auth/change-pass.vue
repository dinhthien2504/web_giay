<template>
    <div class="container-form">
        <div class="form__container">
            <h2 class="mb-3 text-uppercase text-primary text-center">Đổi Mật Khẩu</h2>
            <form @submit.prevent="submitChangePass">
                <div class="mb-3">
                    <input type="email" v-model="email" class="form-control" placeholder="Nhập email của bạn">
                    <p class="text-danger" v-if="errors.email">
                        {{ Array.isArray(errors.email) ? errors.email[0] : errors.email }}
                    </p>
                </div>
                <div class="mb-3">
                    <input type="password" v-model="password" class="form-control" placeholder="Nhập mật khẩu cũ">
                    <p class="text-danger" v-if="errors.password">
                        {{ Array.isArray(errors.password) ? errors.password[0] : errors.password }}
                    </p>
                </div>
                <div class="mb-3">
                    <input type="password" v-model="password_new" class="form-control" placeholder="Nhập mật khẩu mới">
                    <p class="text-danger" v-if="errors.password_new">
                        {{ Array.isArray(errors.password_new) ? errors.password_new[0] : errors.password_new }}
                    </p>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đổi mật khẩu</button>
                <div class="mt-3 text-center">
                    <router-link to="/dang-nhap" class="text-primary text-decoration-none cursor-pointer">
                        Quay lại Đăng Nhập
                    </router-link>
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
        const email = ref('');
        const password = ref('');
        const password_new = ref('');

        const submitChangePass = async () => {
            errors.value = {};
            message.value = '';

            if (!email.value.trim()) {
                errors.value.email = 'Trường địa chỉ email không được để trống.';
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                errors.value.email = 'Email bạn nhập vào không hợp lệ.';
            }
            if (!password.value.trim()) {
                errors.value.password = 'Trường mật khẩu cũ không được để trống.';
            }
            if (!password_new.value.trim()) {
                errors.value.password_new = 'Trường mật khẩu mới không được để trống.';
            } else if (password_new.value.length < 6) {
                errors.value.password_new = 'Mật khẩu mới phải có ít nhất 6 ký tự.';
            }
            if (password.value == password_new.value) {
                errors.value.password_new = 'Trường mật khẩu mới phải khác mật khẩu cũ.';
            }
            if (Object.keys(errors.value).length > 0) {
                return;
            }

            try {
                const response = await axios.post(`${urlApi}/change-password`, {
                    email: email.value,
                    password: password.value,
                    password_new: password_new.value,
                });
                message.value = 'Đổi mật khẩu thành công!';
            } catch (error) {
                if (error.response) {
                    errors.value = error.response.data.errors || {};
                    message.value = error.response.data.message;
                }
            }
        };

        return {
            submitChangePass,
            email,
            password,
            password_new,
            errors,
            message
        };
    }
};
</script>
