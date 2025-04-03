<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <router-link to="/admin" class="navbar-brand">ADMIN</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link to="/admin/tai-khoan" class="nav-link active" aria-current="page">Tài
                            Khoản</router-link>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sản Phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <router-link class="dropdown-item" to="/admin/san-pham">Hiển Thị Sản Phẩm</router-link>
                            </li>
                            <!-- <li><a class="dropdown-item" href="#">Thêm Sản Phẩm</a></li> -->
                            <li><a class="dropdown-item" href="#">Thêm Danh Mục</a></li>
                        </ul>
                    </li>
                </ul>
                <div v-if="isLogin" class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="me-2">{{ isLogin.name }}</span>
                        <img src="https://chiemtaimobile.vn/images/companies/1/%E1%BA%A2nh%20Blog/avatar-facebook-dep/Hinh-dai-dien-hai-huoc-meme-deo-kinh.jpg?1704789860473"
                            alt="Avatar Logo" style="width:40px;" class="rounded-pill">

                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Thông tin</a></li>
                        <li><a class="dropdown-item" @click="logout">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { inject } from 'vue';

export default {
    methods: {
        logout() {
            // Xóa thông tin đăng nhập khỏi localStorage
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');

            // Cập nhật trạng thái đăng nhập
            this.isLogin = null;

            // Chuyển hướng về trang đăng nhập
            this.$router.push('/dang-nhap');
        }
    },
    setup() {
        const isLogin = inject('isLogin'); // Lấy dữ liệu đăng nhập nếu đã đăng nhập trước đó
        return {
            isLogin
        };
    }
}
</script>
