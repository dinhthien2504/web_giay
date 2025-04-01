<template>
    <div class="container-form">
        <div class="form__container">
            <h2 class="mb-3 text-uppercase text-primary text-center">Quên Mật Khẩu</h2>
            <p class="text-muted text-center fs-12">Nhập email của bạn để nhận liên kết đặt lại mật khẩu.</p>
            <form @submit.prevent="submitForgotPass">
                <div class="mb-3">
                    <input type="email" v-model="email" class="form-control" placeholder="Nhập email của bạn">
                    <p class="text-danger" v-if="errors.email">
                        {{ Array.isArray(errors.email) ? errors.email[0] : errors.email }}
                    </p>
                </div>
                <button type="submit" class="btn btn-primary w-100">Gửi Yêu Cầu</button>
                <div class="mt-3 text-center">
                    <router-link to="/dang-nhap" class="text-primary text-decoration-none curson-pointer">
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
import { urlApiUsers } from '../../../components/store';
export default {
    setup() {
        const message = ref('');
        const errors = ref({});
        const email = ref('');
        const submitForgotPass = () => {
            //Check dữ liệu phí frontend
            errors.value = {};
            message.value = '';
            // Kiểm tra email
            if (!email.value.trim()) {
                errors.value.email = 'Trường địa chỉ email không được để trống.';
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                errors.value.email = 'Email bạn nhập vào không hợp lệ.';
            }
            if (Object.keys(errors.value).length > 0) {
                return;
            }
            //Gọi api để check đổi mật khẩu
            forgot(email);
        }
        //Viết hàm kiểm tra đổi mật khẩu trên server
        const forgot = async (email) => {
            try {
                const response = await axios.post(`${urlApiUsers}/forgot`, email);
            } catch (error) {
                if (error.response) {
                    errors.value = error.response.data.errors || {};
                    message.value = error.response.data.message;
                }
            }
        };
        return {
            submitForgotPass, email, errors, message
        }
    }
}
</script>