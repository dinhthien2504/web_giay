<template>
    <div class="container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModelAddUser">
            Thêm Tài Khoản
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">1</th>
                    <td>Tên khách hàng</td>
                    <td>diachi@gmail.com</td>
                    <td>
                        <a class="btn btn-warning" href="">Sửa</a>
                        <a class="btn btn-danger ms-2" href="">Khóa</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Modal Add User-->
    <div class="modal fade" id="myModelAddUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Tài Khoản</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên:</label>
                        <input type="text" class="form-control" id="name" placeholder="Nhập tên">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Mật Khẩu:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="pswd">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vai trò:</label>
                        <select class="form-select">
                            <option>Khách hàng</option>
                            <option>Admin</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</template>