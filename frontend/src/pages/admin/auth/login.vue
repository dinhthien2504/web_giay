<template>
    <div class="container__form-login">
        <!-- Form Đăng nhập -->
        <div id="loginForm" class="container-box">
            <h2 class="form-title">Đăng nhập admin</h2>
            <form>
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="loginEmail" required>
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="loginPassword" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Đăng Nhập</button>
            </form>
        </div>
    </div>
</template>