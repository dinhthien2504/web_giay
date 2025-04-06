<template>
    <div v-if="categories" class="container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModelAddCategory">
            Thêm Danh Mục
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Mô Tả</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr v-for="(category, index) in categories" :key="category.id">
                    <th>{{ index + 1 }}</th>
                    <td>{{ category.name }}</td>
                    <td>{{ category.description }}</td>
                    <td>
                        <button class="btn btn-warning" @click="openEditModal(category)">Sửa</button>
                        <button class="btn btn-danger ms-2" @click="deleteCategory(category.id)">Xóa</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else class="container__spinner">
        <div class="spinner-border text-primary"></div>
    </div>
    <!-- Modal Add Category -->
    <div class="modal fade" id="myModelAddCategory" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" @submit.prevent="submitAddCategory">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Danh Mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success" v-if="message_success">{{ message_success }}</p>
                    <div class="mb-3">
                        <label class="form-label">Tên Danh Mục:</label>
                        <input type="text" v-model="category.name" class="form-control">
                        <p class="text-danger" v-if="errors.name">{{ Array.isArray(errors.name) ? errors.name[0] :
                            errors.name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô Tả:</label>
                        <textarea v-model="category.description" class="form-control" rows="3"></textarea>
                        <p class="text-danger" v-if="errors.description">{{ errors.description }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button class="btn btn-primary" type="submit">Lưu</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Category -->
    <div class="modal fade" id="modalEditCategory" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" @submit.prevent="submitEditCategory">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="alert alert-success" v-if="message_success">{{ message_success }}</p>
                    <div class="mb-3">
                        <label class="form-label">Tên:</label>
                        <input type="text" class="form-control" v-model="categoryEdit.name">
                        <p class="text-danger" v-if="errors.name">{{ Array.isArray(errors.name) ? errors.name[0] :
                            errors.name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô Tả:</label>
                        <textarea class="form-control" rows="3" v-model="categoryEdit.description"></textarea>
                        <p class="text-danger" v-if="errors.description">{{ Array.isArray(errors.description) ?
                            errors.description[0] :
                            errors.description }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
import { Modal } from 'bootstrap';

export default {
    emits: ["success-login"],
    setup() {
        const message_success = ref('');
        const categories = ref([]);
        const category = ref({ name: '', description: '' });
        const categoryEdit = ref({ id: null, name: '', description: '' });
        const errors = ref({});

        const getCategories = async () => {
            try {
                const res = await axios.get(`${urlApi}/categories`);
                categories.value = res.data.categories;
            } catch (err) {
                console.error("Lỗi lấy danh mục:", err);
            }
        };

        const validateCategory = () => {
            errors.value = {};
            if (!category.value.name.trim()) errors.value.name = "Tên không được trống";
            if (!category.value.description.trim()) errors.value.description = "Mô tả không được trống";
            return Object.keys(errors.value).length === 0;
        };

        const submitAddCategory = async () => {
            if (!validateCategory()) return;
            try {
                const res = await axios.post(`${urlApi}/categories`, category.value);
                if (res.status === 201) {
                    categories.value.push(res.data.category);
                    Object.assign(category.value, { name: '', description: '' });
                    message_success.value = res.data.message;
                }
            } catch (err) {
                if (err.response?.data?.errors) errors.value = err.response.data.errors;
                else console.error('Lỗi khi thêm:', err);
            }
        };

        const openEditModal = (category) => {
            message_success.value = '';
            categoryEdit.value = { ...category };
            new Modal(document.getElementById("modalEditCategory")).show();
        };

        const submitEditCategory = async () => {
            try {
                const res = await axios.put(`${urlApi}/categories/${categoryEdit.value.id}`, categoryEdit.value);
                if (res.status === 200) {
                    const i = categories.value.findIndex(c => c.id === categoryEdit.value.id);
                    if (i !== -1) categories.value[i] = { ...categoryEdit.value };
                    const el = document.getElementById("modalEditCategory");
                    const instance = Modal.getInstance(el);
                    instance?.hide();
                }
            } catch (err) {
                if (err.response?.data?.errors) errors.value = err.response.data.errors;
                else console.error('Lỗi khi sửa:', err);
            }
        };

        const deleteCategory = async (id) => {
            if (!confirm("Bạn có chắc muốn xóa?")) return;
            try {
                await axios.delete(`${urlApi}/categories/${id}`);
                categories.value = categories.value.filter(c => c.id !== id);
                alert("Xóa thành công!");
            } catch (err) {
                if (err.response && err.response.status === 400) {
                    alert(err.response.data.message);
                } else {
                    alert('Có lỗi xảy ra khi xóa danh mục.');
                    console.error(err);
                }
            }
        };

        onMounted(() => {
            getCategories();
        });

        return {
            categories, category, categoryEdit, errors, message_success,
            submitAddCategory, submitEditCategory, openEditModal, deleteCategory
        };
    }
};
</script>
