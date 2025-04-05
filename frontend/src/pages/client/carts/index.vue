<template>
    <!-- Giỏ hàng -->
    <div class="container my-2">
        <h3 class="mb-4">Giỏ hàng của bạn</h3>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cart in carts">
                        <td><img :src="`/img/${cart.image}`" alt="Giày" width="80"></td>
                        <td>{{ cart.name }}</td>
                        <td>{{ Number(cart.price).toLocaleString('vi-VN', {
                            style: 'currency', currency: 'VND'
                        }) }}</td>
                        <td>
                            <input type="number" value="1" min="1" class="form-control" style="width: 70px;" />
                        </td>
                        <td>{{ Number(cart.price).toLocaleString('vi-VN', {
                            style: 'currency', currency: 'VND'
                        }) }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger">Xoá</button>
                        </td>
                    </tr>
                    <!-- Có thể lặp thêm nhiều sản phẩm ở đây -->
                </tbody>
            </table>
        </div>
        <div class="text-end">
            <h5>Tổng cộng: <span class="text-primary">{{ Number(total).toLocaleString('vi-VN', {
                style: 'currency', currency: 'VND'
                    }) }}</span></h5>
            <button class="btn btn-primary mt-2">Thanh toán</button>
        </div>
    </div>
</template>
<script>
import { onMounted, ref } from 'vue';
export default {
    emits: ['success-login'],
    setup() {
        const total = ref(0);
        const carts = ref([
            { id: 9, image: 'shoe1.jpg', name: 'Giày Jordan 1 Retro High OG', description: 'Giày thể thao Jordan 1 Retro High OG mang phong cách huyền thoại, dành cho fan sneaker chính hiệu.', price: '2690000', stock: 35 },
            { id: 8, image: 'shoe2.jpg', name: 'Giày Chạy Bộ Puma Velocity', description: 'Giày chạy bộ Puma Velocity nhẹ và bám đường tốt, giúp cải thiện hiệu suất chạy bộ hàng ngày.', price: '1990000', stock: 80 },
            { id: 7, image: 'shoe3.jpg', name: 'Giày Vans Old Skool Đen Trắng', description: 'Giày Vans Old Skool với thiết kế đặc trưng, phù hợp cho những ai yêu thích phong cách streetwear.', price: '3090000', stock: 45 },
            { id: 6, image: 'shoe4.jpg', name: 'Giày Converse Chuck Taylor Classic', description: 'Giày Converse Chuck Taylor Classic phong cách cổ điển, phù hợp với mọi outfit dạo phố.', price: '1890000', stock: 70 }
        ]);
        const totalCart = () => {
            total.value = carts.value.reduce((sum, item) => {
                // Tính tổng giá trị: price * stock (hoặc số lượng sản phẩm)
                return sum + (parseInt(item.price));
            }, 0);
        }
        onMounted(() => {
            totalCart();
        })
        return {
            carts, total
        }
    }
}
</script>