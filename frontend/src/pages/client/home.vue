<template>
    <!-- Banner -->
    <section class="banner">
        <img src="/img/banner1.jpg" class="active" alt="Banner 1">
        <img src="/img/banner2.jpg" alt="Banner 2">
        <img src="/img/banner3.jpg" alt="Banner 3">
        <div class="banner-buttons">
            <button onclick="prevSlide()">&#10094;</button>
            <button onclick="nextSlide()">&#10095;</button>
        </div>
    </section>
    <!-- End Banner -->
    <section class="product-section">
        <h2>Sản phẩm nổi bật</h2>
        <div class="product-list">
            <div class="product">
                <img src="/img/shoe1.jpg" alt="Hình ảnh">
                <h3>Tên sản phẩm</h3>
                <p>Giá: 100.000 đ</p>
                <div class="buttons">
                    <button>Mua ngay</button>
                    <button>Thêm vào giỏ</button>
                </div>
            </div>
        </div>
    </section>
</template>