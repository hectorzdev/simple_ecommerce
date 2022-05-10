<?php include '_header.php'; ?>
<div class="container">
    <div class="card mt-4">
        <div class="card-header form-inline">
            <h4>เพิ่มสินค้า</h4>
        </div>
        <div class="card-body">

            <form id="addProduct">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="type_id">ประเภทสินค้า</label>
                        <select name="type_id" id="type_id" class="form-control" required>
                            <?php
                            $sql = "SELECT * FROM product_types";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <option value="<?= $row['type_id'] ?>"><?php echo $row['type_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_name">ชื่อสินค้า</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_price">ราคาสินค้า</label>
                        <input type="number" name="product_price" id="product_price" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_stock">จำนวนสินค้า</label>
                        <input type="number" name="product_stock" id="product_stock" class="form-control" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="product_details">รายละเอียดสินค้า</label>
                        <!-- <textarea class="form-control" id="product_details" rows="3" name="product_details"></textarea> -->
                        <textarea name="product_details" id="product_details" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_image">รูปภาพสินค้า</label>
                        <input type="file" name="product_image" id="product_image" class="form-control-file" required>
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

<script>
    CKEDITOR.replace("product_details")

    $("#addProduct").submit(function(e) {
        e.preventDefault()
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData(this)
        jQuery.ajax({
            url: "../main.php?action=add_product",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                output = JSON.parse(data)
                if (output.success) {
                    swal("แจ้งเตือน!", "เพิ่มสินค้าสำเร็จ", "success").then(function() {
                        window.location = 'products.php'
                    })
                } else {
                    swal("แจ้งเตือน!", " " + output.msg, "error")
                }
            }

        })
    })

    // function readURL(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();

    //         reader.onload = function(e) {
    //             $('#preview')
    //                 .attr('src', e.target.result);
    //         };

    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }
</script>
</body>

</html>