<template>
  <div class="container-form">
    <div class="form__container">
      <div class="text-center">
        <img src="/img/logo.jpg" class="brand-logo mb-3 text-center" alt="Logo ShoeStore" />
      </div>
      <h2 class="mb-3 text-uppercase text-primary text-center">Đăng Ký</h2>
      
      <!-- Hiển thị thông báo -->
      <p v-if="message" class="alert alert-success">{{ message }}</p>
      <p v-if="errorsMessage" class="alert alert-danger">{{ errorsMessage }}</p>

      <form @submit.prevent="submitRegister">
        <div class="mb-3">
          <input type="text" v-model="user.name" class="form-control" placeholder="Họ và Tên" />
          <p class="text-danger" v-if="errors.name">{{ errors.name }}</p>
        </div>

        <div class="mb-3">
          <input type="email" v-model="user.email" class="form-control" placeholder="Email" />
          <p class="text-danger" v-if="errors.email">{{ errors.email }}</p>
        </div>

        <div class="mb-3">
          <input type="password" v-model="user.password" class="form-control" placeholder="Mật khẩu" />
          <p class="text-danger" v-if="errors.password">{{ errors.password }}</p>
        </div>

        <div class="mb-3">
          <input
            type="password"
            v-model="user.password_confirmation"
            class="form-control"
            placeholder="Xác nhận mật khẩu"
          />
          <p class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation }}</p>
        </div>

        <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>

        <div class="mt-2 text-center">
          <span>Đã có tài khoản?
            <router-link to="/dang-nhap" class="text-primary">Đăng nhập</router-link>
          </span>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
import { urlApi } from "../../../components/store";

export default {
  setup() {
    const errors = ref({});
    const message = ref("");
    const errorsMessage = ref("");
    const user = ref({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    });

    const submitRegister = async () => {
      errors.value = {};
      message.value = "";
      errorsMessage.value = "";

      // Kiểm tra dữ liệu trước khi gửi
      if (!user.value.name.trim()) {
        errors.value.name = "Họ và tên không được để trống.";
      } else if (user.value.name.length < 3) {
        errors.value.name = "Họ và tên phải có ít nhất 3 ký tự.";
      }

      if (!user.value.email.trim()) {
        errors.value.email = "Email không được để trống.";
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(user.value.email)) {
        errors.value.email = "Email không hợp lệ.";
      }

      if (!user.value.password.trim()) {
        errors.value.password = "Mật khẩu không được để trống.";
      } else if (user.value.password.length < 6) {
        errors.value.password = "Mật khẩu phải có ít nhất 6 ký tự.";
      }

      if (!user.value.password_confirmation.trim()) {
        errors.value.password_confirmation = "Xác nhận mật khẩu không được để trống.";
      } else if (user.value.password_confirmation !== user.value.password) {
        errors.value.password_confirmation = "Mật khẩu xác nhận không khớp.";
      }

      // Nếu có lỗi, dừng lại
      if (Object.keys(errors.value).length > 0) {
        return;
      }

      try {
        const response = await axios.post(`${urlApi}/register`, user.value);
        
        // Kiểm tra phản hồi từ server
        if (response.status === 200 || response.status === 201) {
          message.value = "Đăng ký thành công!";
          user.value = { name: "", email: "", password: "", password_confirmation: "" };
        } else {
          errorsMessage.value = response.data.message || "Có lỗi xảy ra, vui lòng thử lại!";
        }
      } catch (error) {
        if (error.response) {
          if (error.response.status === 422) {
            errors.value = error.response.data.errors || {};
            errorsMessage.value = error.response.data.message || "Lỗi xác thực dữ liệu!";
          } else {
            errorsMessage.value = "Lỗi kết nối đến server!";
          }
        } else {
          errorsMessage.value = "Không thể kết nối đến server!";
        }
      }
    };

    return {
      user,
      message,
      errors,
      errorsMessage,
      submitRegister,
    };
  },
};
</script>
