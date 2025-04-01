    <template>
        <div class="container-form ">
            <div class="form__container">
                <div class="text-center">
                    <img src="/img/logo.jpg" class="brand-logo mb-3 text-center" alt="Logo ShoeStore">
                </div>
                <h2 class="mb-3 text-uppercase text-primary text-center">Đăng Ký</h2>
                <p v-if="message" class="alert alert-success">{{ message }}</p>
                <form @submit.prevent="submitRegister">
                    <div class="mb-3">
                        <input type="text" v-model="user.name" class="form-control" placeholder="Họ và Tên">
                        <p class="text-danger" v-if="errors.name">{{ Array.isArray(errors.name) ?
                            errors.name[0] : errors.name }}</p>
                    </div>
                    <div class="mb-3">
                        <input type="email" v-model="user.email" class="form-control" placeholder="Email">
                        <p class="text-danger" v-if="errors.email">{{ Array.isArray(errors.email) ?
                            errors.email[0] : errors.email }}</p>
                    </div>
                    <div class="mb-3">
                        <input type="password" v-model="user.password" class="form-control" placeholder="Mật khẩu">
                        <p class="text-danger" v-if="errors.password">{{ Array.isArray(errors.password) ?
                            errors.password[0] : errors.password }}</p>
                    </div>
                    <div class="mb-3">
                        <input type="password" v-model="user.password_confirmation" class="form-control" placeholder="Mật khẩu">
                        <p class="text-danger" v-if="errors.password">{{ Array.isArray(errors.password) ?
                            errors.password[0] : errors.password }}</p>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
                    <div class="mt-2 text-center">
                        <span>Đã có tài khoản? <router-link to="/dang-nhap" class="text-primary ">Đăng
                                nhập</router-link></span>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <script>    
    import { ref } from 'vue';
    import axios from 'axios';
    import { urlApi } from '../../../components/store';
    export default {
        setup() {
            const errors = ref({});
            const message = ref('');
            const user = ref({
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            });
            const submitRegister = () => {
                //Check lỗi bên frontend
                errors.value = {};
                message.value = '';
                // Kiểm tra họ tên
                if (!user.value.name.trim()) {
                    errors.value.name = 'Trường tên không được để trống.';
                } else if (user.value.name.length < 3) {
                    errors.value.name = 'Trường tên phải có ít nhất 3 ký tự';
                }

                // Kiểm tra email
                if (!user.value.email.trim()) {
                    errors.value.email = 'Trường địa chỉ email không được để trống.';
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(user.value.email)) {
                    errors.value.email = 'Email bạn nhập vào không hợp lệ.';
                }

                // Kiểm tra mật khẩu
                if (!user.value.password.trim()) {
                    errors.value.password = 'Trường mật khẩu không được để trống.';
                } else if (user.value.password.length < 6) {
                    errors.value.password = 'Mật khẩu bạn nhập phải lớn hơn 6 ký tự.';
                }
                // Nếu có lỗi thì không gửi request
                if (Object.keys(errors.value).length > 0) {
                    return;
                }
                //Nếu không có lỗi gì thì gửi lên server
                register(user.value)
            }
            const register = async (user) => {
                try {
                    errors.value = {}; // Reset lỗi cũ
                    const response = await axios.post(`${urlApi}/register`, user);

                    // Nếu đăng ký thành công
                    message.value = response.data;
                    user.name = '';
                    user.email = '';
                    user.password = '';

                } catch (error) {
                    console.log(error);
                    
                    if (error.response && error.response.data.errors) {
                        errors.value = error.response.data.errors;
                    } else {
                        message.value = "Lỗi kết nối đến server!";
                    }
                }
            };

            return {
                user,
                message,
                errors,
                register,
                submitRegister
            };
        }
    };
    </script>