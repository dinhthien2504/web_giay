<template>
    <div v-if="products" class="container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModelAddPro">
            Thêm Sản Phẩm
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Danh Mục</th>
                    <th>Giá</th>
                    <th>Lượt Bán</th>
                    <th>Số Lượng</th>
                    <th>Hình Ảnh</th>
                    <th>Mô Tả</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr v-for="(pro, index) in products" :key="pro.id">
                    <th>{{ index + 1 }}</th>
                    <td>{{ pro.name }}</td>
                    <td>{{ nameCategory(pro.category_id) }}</td>
                    <td>{{ Number(pro.price).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }) }}</td>
                    <td>{{ pro.sell }}</td>
                    <td>{{ pro.stock }}</td>
                    <td><img :src="`/img/${pro.image}`" style="width: 40px; height: 40px; object-fit: cover;"></td>
                    <td>{{ pro.description }}</td>
                    <td>
                        <button class="btn btn-warning" @click="openEditModal(pro)">Sửa</button>
                        <button class="btn btn-danger ms-2" @click="deleteProduct(pro.id)">Xóa</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else class="container__spinner">
        <div class="spinner-border text-primary"></div>
    </div>
    <!-- Modal Add Product -->
    <div class="modal fade" id="myModelAddPro" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" @submit.prevent="submitAddProduct" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Sản Phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success" v-if="message_success">{{ message_success }}</p>
                    <div class="mb-3">
                        <label class="form-label">Tên Sản Phẩm:</label>
                        <input type="text" v-model="product.name" class="form-control">
                        <p class="text-danger" v-if="errors.name">{{ errors.name }}</p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Giá:</label>
                            <input type="number" v-model="product.price" class="form-control">
                            <p class="text-danger" v-if="errors.price">{{ errors.price }}</p>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Số lượng:</label>
                            <input type="number" v-model="product.stock" class="form-control">
                            <p class="text-danger" v-if="errors.stock">{{ errors.stock }}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh:</label>
                        <input type="file" class="form-control" accept="image/*" @change="handleFileUpload">
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
                        <label class="form-label">Mô tả:</label>
                        <textarea v-model="product.description" class="form-control" rows="3"></textarea>
                        <p class="text-danger" v-if="errors.description">{{ errors.description }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button class="btn btn-primary" type="submit">Lưu</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Product -->
    <div class="modal fade" id="modalEditProduct" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" @submit.prevent="submitEditProduct" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success" v-if="message_success">{{ message_success }}</p>
                    <div class="mb-3">
                        <label class="form-label">Tên:</label>
                        <input type="text" class="form-control" v-model="productEdit.name">
                        <p class="text-danger" v-if="errors.name">{{ errors.name }}</p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Giá:</label>
                            <input type="number" class="form-control" v-model="productEdit.price">
                            <p class="text-danger" v-if="errors.price">{{ errors.price }}</p>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Số lượng:</label>
                            <input type="number" class="form-control" v-model="productEdit.stock">
                            <p class="text-danger" v-if="errors.stock">{{ errors.stock }}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Danh mục:</label>
                        <select class="form-select" v-model="productEdit.category_id">
                            <option v-for="cate in categories" :key="cate.id" :value="cate.id">{{ cate.name }}</option>
                        </select>
                        <p class="text-danger" v-if="errors.category_id">{{ errors.category_id }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh mới (nếu muốn thay):</label>
                        <input type="file" class="form-control" accept="image/*" @change="handleEditFileUpload">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả:</label>
                        <textarea class="form-control" rows="3" v-model="productEdit.description"></textarea>
                        <p class="text-danger" v-if="errors.description">{{ errors.description }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button class="btn btn-primary" type="submit">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { urlApi } from '../../../components/store';
import { Modal } from 'bootstrap'

export default {
    emits: ["success-login"],
    setup() {
        const message_success = ref('');
        const products = ref([]);
        const categories = ref([]);
        const product = ref({ name: '', price: '', stock: '', image: null, category_id: '', description: '' });
        const productEdit = ref({ id: null, name: '', price: '', stock: '', category_id: '', description: '' });
        const errors = ref({});
        const imageEditFile = ref(null);

        const getPros = async () => {
            try {
                const res = await axios.get(`${urlApi}/products`);
                products.value = res.data.products;
            } catch (err) { console.error("Lỗi lấy SP:", err); }
        };

        const getCategories = async () => {
            try {
                const res = await axios.get(`${urlApi}/categories`);
                categories.value = res.data.categories;
            } catch (err) { console.error("Lỗi lấy danh mục:", err); }
        };
        const nameCategory = (cate_id) => {
            const category = categories.value.find(c => c.id === cate_id);
            return category ? category.name : 'Không rõ danh mục';
        };

        const validateProduct = () => {
            errors.value = {};
            if (!product.value.name.trim()) errors.value.name = "Tên không được trống";
            if (!product.value.price) errors.value.price = "Giá không được trống";
            if (product.value.price <= 0) errors.value.price = "Giá > 0";
            if (!product.value.stock) errors.value.stock = "Số lượng không được trống";
            if (product.value.stock < 1) errors.value.stock = "Số lượng > 0";
            if (!product.value.image) errors.value.image = "Chọn hình ảnh";
            if (!product.value.category_id) errors.value.category_id = "Chọn danh mục";
            if (!product.value.description.trim()) errors.value.description = "Mô tả không trống";
            return Object.keys(errors.value).length === 0;
        };

        const handleFileUpload = (e) => {
            product.value.image = e.target.files[0];
        };

        const submitAddProduct = async () => {
            if (!validateProduct()) return;
            const formData = new FormData();
            for (let key in product.value) formData.append(key, product.value[key]);
            try {
                const res = await axios.post(`${urlApi}/products`, formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });
                if (res.status === 201) {
                    products.value.push(res.data.product);
                    Object.assign(product.value, { name: '', price: '', stock: '', image: null, category_id: '', description: '' });
                    document.querySelector("input[type='file']").value = "";
                    message_success.value = res.data.message;
                }
            } catch (err) {
                if (err.response?.data?.errors) errors.value = err.response.data.errors;
                else console.error('Lỗi khi thêm:', err);
            }
        };

        const openEditModal = (pro) => {
            message_success.value = '';
            errors.value = '';
            productEdit.value = { ...pro };
            const modelEditEl = document.getElementById('modalEditProduct')
            const modal = new Modal(modelEditEl)
            modal.show()
        };
        const handleEditFileUpload = (e) => {
            imageEditFile.value = e.target.files[0];
        };

        const submitEditProduct = async () => {
            const formData = new FormData();

            // Thêm các trường dữ liệu vào FormData
            for (let key in productEdit.value) {
                if (key !== 'image') {
                    formData.append(key, productEdit.value[key]);
                }
            }

            // Nếu có ảnh mới, thêm ảnh vào formData
            if (imageEditFile.value) {
                formData.append('image', imageEditFile.value);
            }

            try {
                // Gửi request PATCH với formData
                const res = await axios.patch(`${urlApi}/products/${productEdit.value.id}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (res.status === 200) {
                    // Cập nhật lại sản phẩm trong frontend
                    const i = products.value.findIndex(p => p.id === productEdit.value.id);
                    if (i !== -1) products.value[i] = { ...productEdit.value };
                    message_success.value = "Cập nhật thành công";
                    bootstrap.Modal.getInstance(document.getElementById("modalEditProduct")).hide();
                }
            } catch (err) {
                if (err.response?.status === 422) {
                    console.log("Lỗi 422");
                }
                console.error("Lỗi khi sửa:", err);
                if (err.response?.data?.errors) {
                    errors.value = err.response.data.errors; // Hiển thị lỗi chi tiết
                } else {
                    alert("Đã xảy ra lỗi khi cập nhật sản phẩm!");
                }
            }
        };



        const deleteProduct = async (id) => {
            if (!confirm("Bạn có chắc muốn xóa?")) return;
            try {
                await axios.delete(`${urlApi}/products/${id}`);
                products.value = products.value.filter(p => p.id !== id);
                alert("Xóa thành công!");
            } catch (err) { alert("Xóa thất bại!"); }
        };

        onMounted(() => {
            getPros();
            getCategories();
        });

        return {
            products, categories, product, productEdit, errors,
            message_success, handleFileUpload, submitAddProduct,
            submitEditProduct, openEditModal, deleteProduct, nameCategory, handleEditFileUpload
        };
    }
};
</script>
