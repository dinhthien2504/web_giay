<template>
    <!-- Chi tiết sản phẩm -->
    <div class="container my-5" v-if="product">
        <div class="row">
            <!-- Ảnh sản phẩm -->
            <div class="col-md-6">
                <img :src="`/img/${product.image}`" alt="Giày" class="img-fluid rounded shadow-sm mb-3">
            </div>
            <!-- Thông tin -->
            <div class="col-md-6">
                <h3>{{ product.name }}</h3>
                <p class="text-muted">Mã sản phẩm: {{ product.id }}</p>
                <h4 class="text-danger">Giá: {{ Number(product.price).toLocaleString('vi-VN', {
                    style: 'currency', currency: 'VND'
                }) }}</h4>
                <p>Đã bán: {{ product.sell }} đôi</p>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Số lượng</label>
                    <input type="number" id="quantity" class="form-control" value="1" min="1" style="width: 100px;">
                </div>

                <button class="btn btn-primary btn-lg me-2"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</button>
                <button class="btn btn-outline-secondary btn-lg">Mua ngay</button>

                <hr>

                <h5>Mô tả sản phẩm</h5>
                <p>{{ product.description }}</p>
            </div>
        </div>
    </div>
    <div v-else class="container__spinner">
        <div class="spinner-border text-primary"></div>
    </div>

</template>
<script>
import { useRoute } from 'vue-router';
import { urlApi } from '../../../components/store'
import axios from 'axios';
import { ref, onMounted } from 'vue';
export default {
    emits: ['success-login'],
    setup() {
        const route = useRoute();
        const pro_id = route.params.id;
        const product = ref();
        //Viết hàm call api lấy sản phẩm chi tiết
        const getPro = async (id) => {
            try {
                const response = await axios.get(`${urlApi}/products/${id}`);
                if (response.status == 200) {
                    product.value = response.data.product;
                    console.log(product);

                }
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 404) {
                        console.log("Hiện tại không có sản phẩm này");
                    }
                } else {
                    errorsMessage.value = "Không thể kết nối đến server!";
                }
            }
        }
        onMounted(async () => {
            await getPro(pro_id);
        })
        return {
            product
        }
    }
}
</script>