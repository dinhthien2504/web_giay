<template>
    <nav class="navbar navbar-expand-lg bg-primary py-2">
        <div class="container">
            <router-link to="/" class="navbar-brand text-light">Logo</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link text-light active" aria-current="page">Trang
                            chủ</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="#" class="nav-link text-light active" aria-current="page">Sản
                            phẩm</router-link>
                    </li>

                </ul>
                <div class="d-flex align-items-center justify-content-between">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn btn-dark" type="submit">Tìm</button>
                    </form>
                    <div class="ms-5 d-flex align-items-center justify-content-between gap-3">
                        <router-link to="/gio-hang" class="text-light fs-5"><i
                                class="fas fa-shopping-cart"></i></router-link>
                        <router-link v-if="!isLogin" to="/dang-nhap" class="text-light fs-5"><i
                                class="far fa-user"></i></router-link>
                        <span class="nav-item dropdown" v-else>
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ isLogin.name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Thông tin</a></li>
                                <li><a class="dropdown-item" href="#">Đơn hàng</a></li>
                                <hr class="my-1">
                                <li><a @click="logout" class="dropdown-item cursor-pointer">Đăng xuất</a></li>
                            </ul>
                        </span>
                    </div>
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
        const isLogin = inject('isLogin');//Lấy dữ liệu đăng nhập nếu đã đăng nhập trước đó
        return {
            isLogin
        }
    }
}
</script>