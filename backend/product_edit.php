<?php include '_header.php';

$id = $_GET['product_id'];
$sql = "SELECT  * FROM `products` WHERE id = $id";
$query = $conn->query($sql);
$result = mysqli_fetch_assoc($query);

?>
<div class="container">
    <div class="card mt-4">
        <div class="card-header form-inline">
            <h4>แก้ไขสินค้า</h4>
        </div>
        <div class="card-body">
            <form id="updateProduct">
                <div class="row">
                    <input type="hidden" name="product_id" value="<?= $result['id'] ?>">
                    <div class="form-group col-md-6">
                        <label for="product_name">ชื่อสินค้า</label>
                        <input type="text" name="product_name" id="product_name" value="<?= $result['product_name'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_price">ราคาสินค้า</label>
                        <input type="number" name="product_price" id="product_price" value="<?= $result['product_price'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_stock">จำนวนสินค้า</label>
                        <input type="number" name="product_stock" id="product_stock" value="<?= $result['product_stock'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product_image">รูปภาพสินค้า</label>
                        <input type="file" name="product_image" id="product_image" class="form-control-file">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="product_details">รายละเอียดสินค้า</label>
                        <textarea name="product_details" id="product_details" cols="30" rows="10"><?= $result['product_details'] ?></textarea>
                    </div>
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            <h4>รูปภาพสินค้า</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                $sql = "SELECT  * FROM `product_images` WHERE product_id = $id";
                $query = $conn->query($sql);
                while ($image = mysqli_fetch_assoc($query)) { ?>
                    <div class="col-2" id="image_<?= $image['id'] ?>">
                        <img src="../uploads/<?= $image['product_image'] ?>" width="100%" class="mb-3" alt="">
                        <button type="button" onclick="deleteImage(<?= $image['id'] ?>)" class="btn btn-danger w-100 mt-1">ลบรูป</button>
                        <!-- <a href="../main.php?action=delete_image&image=<?= $image['product_image'] ?>&pid=<?= $result['id'] ?>">ลบรูป</a> -->
                    </div>
                <?php } ?>
            </div>
            <form id="uploadProductImages">
                <div class="form-group">
                    <input type="hidden" name="product_id" value="<?= $result['id'] ?>">
                    <label for="product_images">รูปภาพสินค้า</label>
                    <input type="file" name="product_images[]" id="product_images" multiple class="form-control-file">
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-outline-danger">อัพโหลดรูปภาพ</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include '_footer.php'; ?>
<script>
    CKEDITOR.replace("product_details")

    $("#updateProduct").submit(function(e) {
        e.preventDefault()
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = new FormData(this)
        jQuery.ajax({
            url: "../main.php?action=update_product",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                output = JSON.parse(data)
                if (output.success) {
                    swal("แจ้งเตือน!", "แก้ไขข้อมูลสินค้าสำเร็จ", "success").then(function() {
                        window.location = 'products.php'
                    })
                } else {
                    swal("แจ้งเตือน!", " " + output.msg, "error")
                }
            }

        })
    })

    $("#uploadProductImages").submit(function(e) {
        e.preventDefault()
        var formData = new FormData(this)
        jQuery.ajax({
            url: "../main.php?action=upload_product_images",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                output = JSON.parse(data)
                if (output.success) {
                    swal("แจ้งเตือน!", "อัพโหลดรูปภาพสำเร็จ", "success").then(function() {
                        location.reload()
                    })
                } else {
                    swal("แจ้งเตือน!", " " + output.msg, "error")
                }
            }

        })
    })

    function deleteImage(id) {
        $.post('../main.php?action=delete_image', {
            id: id
        }, function(data) {
            if (data.success) {
                $("#image_" + id).remove()
            } else {
                swal("แจ้งเตือน", " " + data.msg, "error")
            }
        }, 'json')
    }
</script>

</body>

</html>