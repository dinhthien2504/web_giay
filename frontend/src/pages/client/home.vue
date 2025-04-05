<template>
    <!-- Banner -->
    <section>
        <div id="carouselExample" class="carousel slide container my-2">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://file.hstatic.net/1000230642/file/banner_e_flow_master.jpg" class="d-block w-100"
                        alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://file.hstatic.net/1000230642/file/banner_e_flow_master.jpg" class="d-block w-100"
                        alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://file.hstatic.net/1000230642/file/banner_e_flow_master.jpg" class="d-block w-100"
                        alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- End Banner -->
    <!-- Product News-->
    <section>
        <div class="container">
            <div class="bg-light p-2 my-1">
                <h3 class="fs-5 m-0 text-center text-primary">SẢN PHẨM MỚI</h3>
            </div>
            <div class="row g-2">
                <!-- Pro Item -->
                <div v-for="pro in proNews" class="col-6 col-lg-2 col-md-3 col-sm-4">
                    <router-link class="card cursor-pointer text-decoration-none" :to="`/chi-tiet/${pro.id}`">
                        <img class="card-img-top w-100" style="height: 200px; object-fit: cover;"
                            :src="`/img/${pro.image}`" :alt="pro.name">
                        <div class="card-body p-1">
                            <h4 class="product__title">{{ pro.name }}</h4>
                            <div class="d-flex align-items-center justify-content-between my-2">
                                <p class="m-0 fs-16 text-color fw-bold">{{ Number(pro.price).toLocaleString('vi-VN', {
                                    style: 'currency', currency: 'VND'
                                }) }}</p>
                                <span class="fs-12">Đã bán: {{ pro.sell }}</span>
                            </div>
                            <router-link to="" class="btn btn-sm btn-primary">Mua ngay</router-link>
                        </div>
                    </router-link>
                </div>
                <!-- End Pro Item -->
            </div>
        </div>
    </section>
    <!-- End Product News-->
    <!-- Banner children -->
    <section>
        <div class="container my-2">
            <div class="bg-light p-2 my-1 ">
                <h3 class="fs-5 m-0 text-center text-primary">CHÚNG TÔI CÓ GÌ MỚI</h3>
            </div>
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <img class="w-100" src="https://file.hstatic.net/1000230642/file/banner_giaytennis.jpg"
                        alt="Hình ảnh 1">
                </div>
                <div class="col-12 col-md-4">
                    <img class="w-100" src="https://file.hstatic.net/1000230642/file/banner_giaytay.jpg"
                        alt="Hình ảnh 2">
                </div>
                <div class="col-12 col-md-4">
                    <img class="w-100" src="https://file.hstatic.net/1000230642/file/banner_gauchuatam_510x275.jpg"
                        alt="Hình ảnh 3">
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner children -->
    <!-- Product Sell-->
    <section>
        <div class="container my-2">
            <div class="bg-light p-2 my-1">
                <h3 class="fs-5 m-0 text-center text-primary">SẢN PHẨM BÁN CHẠY</h3>
            </div>
            <div class="row g-2">
                <!-- Pro Item -->
                <div v-for="pro in proSell" class="col-6 col-lg-2 col-md-3 col-sm-4">
                    <router-link class="card cursor-pointer text-decoration-none" :to="`/chi-tiet/${pro.id}`">
                        <img class="card-img-top w-100" style="height: 200px; object-fit: cover;"
                            :src="`/img/${pro.image}`" :alt="pro.name">
                        <div class="card-body p-1">
                            <h4 class="product__title">{{ pro.name }}</h4>
                            <div class="d-flex align-items-center justify-content-between my-2">
                                <p class="m-0 fs-16 text-color fw-bold">{{ Number(pro.price).toLocaleString('vi-VN', {
                                    style: 'currency', currency: 'VND'
                                }) }}</p>
                                <span class="fs-12">Đã bán: {{ pro.sell }}</span>
                            </div>
                            <router-link to="" class="btn btn-sm btn-primary">Mua ngay</router-link>
                        </div>
                    </router-link>
                </div>
                <!-- End Pro Item -->
            </div>
        </div>
    </section>
    <!-- End Product Sell -->
</template>
<script>
import { onMounted, ref } from 'vue'
import { urlApi } from '../../components/store';
import axios from 'axios'
export default {
    emits: ['success-login'],
    setup() {
        const products = ref([]);
        const proNews = ref([]);
        const proSell = ref([]);
        const getPros = async () => {
            const response = await axios.get(`${urlApi}/products`);
            if (response.status == 200) {
                products.value = response.data.products;
                //Lấy sản phẩm mới nhất
                proNews.value = products.value
                    .sort((a, b) => b.id - a.id)
                    .slice(0, 10);
                // Lấy sản phẩm bán chạy
                proSell.value = products.value
                    .filter((pro) => pro.sell > 0)//Lọc nếu lượt bán lớn hơn 0
                    .sort((a, b) => b.sell - a.sell)//Lọc theo lượt bán nhiều nhất
                    .slice(0, 6);//Lấy 6 sản phẩm đầu tiên
            }
        }
        onMounted(() => {
            getPros();
        })
        return {
            proNews, proSell
        }
    }
}
</script>