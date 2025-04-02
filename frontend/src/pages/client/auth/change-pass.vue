<template>
    <div class="container-form">
      <div class="form__container">
        <h2 class="mb-3 text-uppercase text-primary text-center">Đổi Mật Khẩu</h2>
        <p v-if="message" class="alert alert-success">{{ message }}</p>
        <p v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</p>
        <form @submit.prevent="submitChangePass">
          <div class="mb-3">
            <input
              type="email"
              v-model="email"
              class="form-control"
              placeholder="Nhập email của bạn"
            />
            <p class="text-danger" v-if="errors.email">{{ errors.email }}</p>
          </div>
          <div class="mb-3">
            <input
              type="password"
              v-model="password"
              class="form-control"
              placeholder="Nhập mật khẩu cũ"
            />
            <p class="text-danger" v-if="errors.password">
              {{ errors.password }}
            </p>
          </div>
          <div class="mb-3">
            <input
              type="password"
              v-model="password_new"
              class="form-control"
              placeholder="Nhập mật khẩu mới"
            />
            <p class="text-danger" v-if="errors.password_new">
              {{ errors.password_new }}
            </p>
          </div>
          <div class="mb-3">
            <input
              type="password"
              v-model="password_new_confirm"
              class="form-control"
              placeholder="Xác nhận mật khẩu mới"
            />
            <p class="text-danger" v-if="errors.password_new_confirm">
              {{ errors.password_new_confirm }}
            </p>
          </div>
          <button type="submit" class="btn btn-primary w-100">
            Đổi mật khẩu
          </button>
          <div class="mt-3 text-center">
            <router-link
              to="/dang-nhap"
              class="text-primary text-decoration-none cursor-pointer"
            >
              Quay lại Đăng Nhập
            </router-link>
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
      const message = ref("");
      const errorMessage = ref("");
      const errors = ref({});
      const email = ref("");
      const password = ref("");
      const password_new = ref("");
      const password_new_confirm = ref(""); // Thêm biến này để lưu giá trị xác nhận mật khẩu
  
      const submitChangePass = async () => {
        errors.value = {};
        message.value = "";
        errorMessage.value = "";
  
        // Kiểm tra dữ liệu nhập vào
        if (!email.value.trim()) {
          errors.value.email = "Trường địa chỉ email không được để trống.";
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
          errors.value.email = "Email bạn nhập vào không hợp lệ.";
        }
        if (!password.value.trim()) {
          errors.value.password = "Trường mật khẩu cũ không được để trống.";
        }
        if (!password_new.value.trim()) {
          errors.value.password_new = "Trường mật khẩu mới không được để trống.";
        } else if (password_new.value.length < 8) {
          errors.value.password_new = "Mật khẩu mới phải có ít nhất 8 ký tự.";
        } else if (password.value === password_new.value) {
          errors.value.password_new = "Mật khẩu mới phải khác mật khẩu cũ.";
        }
        if (!password_new_confirm.value.trim()) {
          errors.value.password_new_confirm = "Vui lòng xác nhận lại mật khẩu mới.";
        } else if (password_new.value !== password_new_confirm.value) {
          errors.value.password_new_confirm = "Mật khẩu xác nhận không khớp.";
        }
  
        if (Object.keys(errors.value).length > 0) {
          return;
        }
  
        try {
          const response = await axios.post(`${urlApi}/change-password`, {
            email: email.value,
            old_password: password.value,
            new_password: password_new.value,
            new_password_confirmation: password_new_confirm.value,
          });
  
          message.value = response.data.message || "Đổi mật khẩu thành công!";
          email.value = "";
          password.value = "";
          password_new.value = "";
          password_new_confirm.value = ""; // Reset lại input sau khi đổi mật khẩu thành công
        } catch (error) {
          if (error.response) {
            errors.value = error.response.data.errors || {};
            errorMessage.value =
              error.response.data.message || "Có lỗi xảy ra, vui lòng thử lại!";
          }
        }
      };
  
      return {
        submitChangePass,
        email,
        password,
        password_new,
        password_new_confirm, // Trả biến ra ngoài để sử dụng trong template
        errors,
        message,
        errorMessage,
      };
    },
  };
  </script>
  
