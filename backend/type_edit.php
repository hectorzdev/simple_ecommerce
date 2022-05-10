<?php include '_header.php';

$type_id = $_GET['type_id'];
$sql = "SELECT  * FROM `product_types` WHERE type_id = '$type_id'";
$query = $conn->query($sql);
$result = mysqli_fetch_assoc($query);

?>
<div class="container">
    <div class="card mt-4">
        <div class="card-header form-inline">
            <h4>แก้ไขประเภทสินค้า</h4>
        </div>
        <div class="card-body">
            <form id="updateType">
                <div class="row">
                    <input type="hidden" name="type_id" value="<?= $result['type_id'] ?>">
                    <div class="form-group col-md-12">
                        <label for="type_name">ประเภทสินค้า</label>
                        <input type="text" name="type_name" id="type_name" value="<?= $result['type_name'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="type_details">รายละเอียด</label>
                        <textarea class="form-control" id="type_details" rows="3" name="type_details"><?= $result['type_details'] ?></textarea>
                    </div>

                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<?php include '_footer.php'; ?>
<script>
    $("#updateType").submit(function(e) {
        e.preventDefault()
        var formData = new FormData(this)
        jQuery.ajax({
            url: "../main.php?action=update_type",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                output = JSON.parse(data)
                if (output.success) {
                    swal("แจ้งเตือน!", "แก้ไขข้อมูลประเภทสินค้าสำเร็จ", "success").then(function() {
                        window.location = 'types.php'
                    })
                } else {
                    swal("แจ้งเตือน!", " " + output.msg, "error")
                }
            }

        })
    })
</script>

</body>

</html>