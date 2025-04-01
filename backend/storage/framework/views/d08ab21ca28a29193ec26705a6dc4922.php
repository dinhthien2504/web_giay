<form action="<?php echo e(route('product.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="mb-3 mt-3">
        <label for="name" class="form-label">Tên:</label>
        <input type="text" class="form-control" id="name" placeholder="Nhập tên" name="name">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email">
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
</form><?php /**PATH C:\laragon\www\php3.lab\lab\resources\views/product/create.blade.php ENDPATH**/ ?>