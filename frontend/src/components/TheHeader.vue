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
                        <router-link to="/san-pham" class="nav-link text-light active" aria-current="page">Sản
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
                        <router-link to="/dang-nhap" class="text-light fs-5"><i class="far fa-user"></i></router-link>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>