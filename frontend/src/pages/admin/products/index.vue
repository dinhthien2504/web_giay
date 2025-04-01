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
                    <th scope="col">Số Lượng</th>
                    <th scope="col">Hình Ảnh</th>
                    <th scope="col">Mô Tả</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">1</th>
                    <td>Tên sản phẩm</td>
                    <td>Danh mục hihi</td>
                    <td>100.000đ</td>
                    <td>100</td>
                    <td>
                        <img src="/img/shoe1.jpg" alt="Hình ảnh" style="width: 40px; height: 40px; object-fit: cover;">
                    </td>
                    <td>Mô tả</td>
                    <td>
                        <a class="btn btn-warning" href="">Sửa</a>
                        <a class="btn btn-danger ms-2" href="">Khóa</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Modal Add User-->
    <div class="modal fade" id="myModelAddPro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Sản Phẩm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên Sản Phẩm:</label>
                        <input type="text" class="form-control" id="name" placeholder="Nhập tên">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 mt-3">
                                <label for="price" class="form-label">Giá:</label>
                                <input type="number" class="form-control" id="price" placeholder="Nhập giá">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3 mt-3">
                                <label for="quantity" class="form-label">Số lượng:</label>
                                <input type="number" class="form-control" id="quantity" placeholder="Nhập số lượng">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Hình ảnh:</label>
                        <input type="file" class="form-control" id="img">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Danh mục:</label>
                        <select class="form-select">
                            <option>Danh mục 1</option>
                            <option>Danh mục 2</option>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="desciption">Mô tả:</label>
                        <textarea class="form-control" rows="5" id="comment" name="text"></textarea>
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