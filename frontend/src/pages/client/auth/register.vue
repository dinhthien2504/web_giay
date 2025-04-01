<template>
    <div class="container-form ">
        <div class="register-container text-center">
            <img src="/img/logo.jpg" class="brand-logo mb-3" alt="Logo ShoeStore">
            <h2 class="mb-3 text-uppercase text-primary">Đăng Ký</h2>
            <form>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Họ và Tên" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Mật khẩu" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Xác nhận mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
                <div class="mt-2">
                    <span>Đã có tài khoản? <router-link to="/dang-nhap" class="text-primary">Đăng
                            nhập</router-link></span>
                </div>
            </form>
        </div>
    </div>
</template>