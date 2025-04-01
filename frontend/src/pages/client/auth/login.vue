<template>
    <div class="container-form">
        <div class="login-container text-center">
            <img src="/img/logo.jpg" class="brand-logo mb-3" alt="Logo ShoeStore">
            <h2 class="mb-3 text-uppercase text-primary">Đăng Nhập</h2>
            <form>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                <div class="mt-3">
                    <router-link to="/quen-mk" class="text-primary">Quên mật khẩu?</router-link>
                </div>
                <div class="mt-2">
                    <span>Chưa có tài khoản? <router-link to="/dang-ky" class="text-primary">Đăng
                            ký</router-link></span>
                </div>
            </form>
        </div>
    </div>
</template>