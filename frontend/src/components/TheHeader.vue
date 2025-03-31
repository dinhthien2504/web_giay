<template>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container">
            <router-link class="navbar-brand" to="/">Logo</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Trang chủ</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/dang-nhap">Đăng nhập</router-link>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="text" placeholder="Tìm kiếm">
                    <button class="btn btn-primary" type="button">Tìm</button>
                </form>
            </div>
        </div>
    </nav>
</template>