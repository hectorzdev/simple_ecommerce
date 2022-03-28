<?php include '_header.php'; ?>
<div class="container">
    <div class="card mt-4">
        <div class="card-header form-inline">
            <h4>เพิ่มสินค้า</h4>
        </div>
        <div class="card-body">
            <form action="../main.php?action=add_product" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="product_name">ชื่อสินค้า</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_price">ราคาสินค้า</label>
                        <input type="number" name="product_price" id="product_price" class="form-control" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_stock">จำนวนสินค้า</label>
                        <input type="number" name="product_stock" id="product_stock" class="form-control" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_image">รูปภาพสินค้า</label>
                        <input type="file" name="product_image" id="product_image" class="form-control-file" required >
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success">เพิ่มสินค้า</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include '_footer.php'; ?>
</body>
</html>