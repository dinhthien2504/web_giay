<template>
    <div class="container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModelAddPro">
            Thêm Sản Phẩm
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Danh Mục</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Lượt Bán</th>
                    <th scope="col">Số Lượng</th>
                    <th scope="col">Hình Ảnh</th>
                    <th scope="col">Mô Tả</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr v-for="(pro, index) in products" :key="pro.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ pro.name }}</td>
                    <td>{{ pro.category_id }}</td>
                    <td>{{ (pro.price).toLocaleString() }}đ</td>
                    <td>{{ pro.sell }}</td>
                    <td>{{ pro.stock }}</td>
                    <td>
                        <img :src="`/img/${pro.image}`" alt="Hình ảnh"
                            style="width: 40px; height: 40px; object-fit: cover;">
                    </td>
                    <td>{{ pro.description }}</td>
                    <td>
                        <button type="button" class="btn btn-warning">Sửa</button>
                        <button type="button" class="btn btn-danger ms-2">Xóa</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Add Product -->
    <div class="modal fade" id="myModelAddPro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" @submit.prevent="submitAddProduct" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Sản Phẩm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success" v-if="message_success">{{ message_success }}</p>
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên Sản Phẩm:</label>
                        <input type="text" v-model="product.name" class="form-control" id="name" placeholder="Nhập tên">
                        <p class="text-danger" v-if="errors.name">{{ errors.name }}</p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá:</label>
                                <input type="number" v-model="product.price" class="form-control" id="price"
                                    placeholder="Nhập giá">
                                <p class="text-danger" v-if="errors.price">{{ errors.price }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Số lượng:</label>
                                <input type="number" v-model="product.stock" class="form-control" id="stock"
                                    placeholder="Nhập số lượng">
                                <p class="text-danger" v-if="errors.stock">{{ errors.stock }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh:</label>
                        <input type="file" name="image" class="form-control" accept="image/*"
                            @change="handleFileUpload">
                        <p class="text-danger" v-if="errors.image">{{ errors.image }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Danh mục:</label>
                        <select v-model="product.category_id" class="form-select">
                            <option value="">Chọn danh mục</option>
                            <option v-for="cate in categories" :key="cate.id" :value="cate.id">{{ cate.name }}</option>
                        </select>
                        <p class="text-danger" v-if="errors.category_id">{{ errors.category_id }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="description">Mô tả:</label>
                        <textarea v-model="product.description" class="form-control" rows="5"></textarea>
                        <p class="text-danger" v-if="errors.description">{{ errors.description }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { urlApi } from '../../../components/store';

export default {
    setup() {
        const message_success = ref('');
        const products = ref([]);
        const categories = ref([]);
        const product = ref({
            name: '',
            price: '',
            stock: '',
            image: null,
            category_id: '',
            description: ''
        });
        const errors = ref({});

        const getPros = async () => {
            try {
                const response = await axios.get(`${urlApi}/products`);
                products.value = response.data.products;
            } catch (error) {
                console.error("Lỗi khi lấy dữ liệu:", error);
            }
        };

        const getCategories = async () => {
            try {
                const response = await axios.get(`${urlApi}/categories`);
                categories.value = response.data.categories;
            } catch (error) {
                console.error("Lỗi khi lấy danh mục:", error);
            }
        };

        const validateProduct = () => {
            errors.value = {};
            if (!product.value.name.trim()) errors.value.name = "Tên sản phẩm không được để trống.";
            if (!product.value.price) errors.value.price = "Giá không được để trống.";
            if (product.value.price <= 0) errors.value.price = "Giá phải lớn hơn 0.";
            if (!product.value.stock) errors.value.stock = "Số lượng không được để trống.";
            if (product.value.stock < 1) errors.value.stock = "Số lượng phải lớn hơn 0.";
            if (!product.value.image) errors.value.image = "Vui lòng chọn hình ảnh.";
            if (!product.value.category_id) errors.value.category_id = "Vui lòng chọn danh mục.";
            if (!product.value.description.trim()) errors.value.description = "Mô tả không được để trống.";
            return Object.keys(errors.value).length === 0;
        };

        const handleFileUpload = (event) => {
            product.value.image = event.target.files[0];
        };

        const submitAddProduct = async () => {
            if (!validateProduct()) return;
            console.log("Dữ liệu hợp lệ", product.value);
            // Gửi dữ liệu lên server
            postProduct(product.value);
        };

        const postProduct = async (product) => {
            try {
                message_success.value = '';
                errors.value = {}; // Reset lỗi cũ
                const formData = new FormData();
                formData.append('name', product.name);
                formData.append('price', product.price);
                formData.append('stock', product.stock);
                formData.append('category_id', product.category_id);
                formData.append('description', product.description);
                formData.append('image', product.image);

                const response = await axios.post(`${urlApi}/products`, formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });
                if (response.status == 201) {
                    console.log(response);
                    products.value.push(response.data.product);
                    // Reset form về trạng thái ban đầu
                    product.name = '';
                    product.price = '';
                    product.stock = '';
                    product.image = null;
                    product.category_id = '';
                    product.description = '';
                    // Reset input file
                    const fileInput = document.querySelector("input[type='file']");
                    if (fileInput) {
                        fileInput.value = "";
                    }
                    message_success.value = response.data.message;
                }
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    errors.value = error.response.data.errors;
                    console.log("Dữ liệu errors: ", error.response);
                } else {
                    console.log('Lỗi kết nối đến server!');
                }
            }
        }
        onMounted(() => {
            getPros();
            getCategories();
        });

        return {
            products,
            categories,
            product,
            errors,
            submitAddProduct,
            handleFileUpload,
            message_success
        };
    }
};
</script>
