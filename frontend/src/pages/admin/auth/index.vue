<template>
    <div class="container">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModelAddUser">
        Thêm Tài Khoản
      </button>
  
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col">Email</th>
            <th scope="col">Vai Trò</th>
            <th scope="col">Trạng Thái</th>
            <th scope="col">Thao Tác</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <tr v-for="(user, index) in users" :key="user.id">
            <th scope="row">{{ index + 1 }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.role == 0 ? "Khách hàng" : "Quản trị" }}</td>
            <td>
              <span :class="user.status == 0 ? 'text-success' : 'text-danger'">
                {{ user.status == 0 ? "Hoạt động" : "Bị khóa" }}
              </span>
            </td>
            <td>
              <button 
                class="btn ms-2"
                :class="user.status == 0 ? 'btn-success' : 'btn-danger'"
                @click="toggleStatus(user)"
              >
                {{ user.status == 0 ? "Khóa" : "Mở khóa" }}
              </button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Modal Add User -->
      <div class="modal fade" id="myModelAddUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form class="modal-content" @submit.prevent="addUser">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Tài Khoản</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
  
            <div class="modal-body">
              <div class="mb-3">
                <label for="name" class="form-label">Tên:</label>
                <input type="text" class="form-control" v-model="name" placeholder="Nhập tên" />
                <p class="text-danger" v-if="errors.name">{{ errors.name }}</p>
              </div>
  
              <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" v-model="email" placeholder="Nhập email" />
                <p class="text-danger" v-if="errors.email">{{ errors.email }}</p>
              </div>
  
              <div class="mb-3">
                <label for="password" class="form-label">Mật Khẩu:</label>
                <input type="password" class="form-control" v-model="password" placeholder="Nhập mật khẩu" />
                <p class="text-danger" v-if="errors.password">{{ errors.password }}</p>
              </div>
  
              <p v-if="message" class="alert alert-success">{{ message }}</p>
              <p v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</p>
            </div>
  
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  import { onMounted, ref } from "vue";
  import { urlApi } from "../../../components/store";
  
  export default {
    setup() {
      const users = ref([]);
      const name = ref("");
      const email = ref("");
      const password = ref("");
      const errors = ref({});
      const message = ref("");
      const errorMessage = ref("");
  
      // Lấy danh sách users
      const getUsers = async () => {
        try {
          const response = await axios.get(`${urlApi}/users`);
          users.value = response.data.users;
        } catch (error) {
          console.error("Lỗi khi lấy dữ liệu:", error);
        }
      };
  
      onMounted(() => {
        getUsers();
      });
  
      // Thêm user mới
      const addUser = async () => {
        errors.value = {};
        message.value = "";
        errorMessage.value = "";
  
        if (!name.value.trim()) {
          errors.value.name = "Tên không được để trống.";
        }
        if (!email.value.trim()) {
          errors.value.email = "Email không được để trống.";
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
          errors.value.email = "Email không hợp lệ.";
        }
        if (!password.value.trim()) {
          errors.value.password = "Mật khẩu không được để trống.";
        } else if (password.value.length < 8) {
          errors.value.password = "Mật khẩu phải có ít nhất 8 ký tự.";
        }
  
        if (Object.keys(errors.value).length > 0) {
          return;
        }
  
        try {
          await axios.post(`${urlApi}/register`, {
            name: name.value,
            email: email.value,
            password: password.value,
            role: 1,
          });
  
          message.value = "Thêm người dùng thành công!";
          getUsers(); // Cập nhật danh sách sau khi thêm
          name.value = "";
          email.value = "";
          password.value = "";
        } catch (error) {
          if (error.response) {
            errorMessage.value = error.response.data.message || "Có lỗi xảy ra, vui lòng thử lại!";
          }
        }
      };
  
      // Cập nhật trạng thái người dùng
      const toggleStatus = async (user) => {
        try {
          const newStatus = user.status === 1 ? 0 : 1; // Đảo trạng thái
          await axios.put(`${urlApi}/users/${user.id}/toggle-status`, { status: newStatus });
  
          // Cập nhật trực tiếp trên giao diện
          user.status = newStatus;
        } catch (error) {
          console.error("Lỗi khi cập nhật trạng thái:", error);
        }
      };
  
      return {
        users,
        name,
        email,
        password,
        errors,
        message,
        errorMessage,
        addUser,
        toggleStatus,
      };
    },
  };
  </script>
  