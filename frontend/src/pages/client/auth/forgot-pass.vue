<template>
    <div class="container-form">
        <div class="forgot-password-container text-center">
            <h2 class="mb-3 text-uppercase text-primary">Quên Mật Khẩu</h2>
            <p class="text-muted">Nhập email của bạn để nhận liên kết đặt lại mật khẩu.</p>
            <form>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Nhập email của bạn" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Gửi Yêu Cầu</button>
                <div class="mt-3">
                    <router-link to="/dang-nhap" class="text-primary text-decoration-none curson-pointer">
                        Quay lại Đăng Nhập
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>