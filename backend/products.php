<?php include '_header.php'; ?>
<div class="container">
    <div class="card mt-4">
        <div class="card-header form-inline">
            <h4>จัดการสินค้า</h4>
            <a type="button" class="btn btn-primary ml-auto modal-lg" data-toggle="modal" data-target="#addproduct_types" data-whatever="@mdo">เพิ่มประเภทสินค้า</a>
            <a href="product_create.php" type="button" class="btn btn-success ml-2">เพิ่มสินค้า</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">รูปภาพสินค้า</th>
                        <th scope="col" style="width: 40%;">ชื่อสินค้า</th>
                        <th scope="col">ราคาสินค้า</th>
                        <th scope="col">จำนวนคงเหลือ</th>
                        <th scope="col">จัดการสินค้า</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $sql = "SELECT * FROM products"; // คำสั่ง SQL
                    $query = $conn->query($sql); // การ Query SQL
                    while ($result = mysqli_fetch_assoc($query)) { // การลูปข้อมูลมาแสดง
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <img src="../uploads/<?= $result['product_image'] ?>" width="100" alt="">
                            </td>
                            <td><?= $result['product_name'] ?></td>
                            <td>THB <?= number_format($result['product_price']) ?></td>
                            <td><?= $result['product_stock'] ?> ชิ้น</td>
                            <td>
                                <a type="button" href="product_edit.php?product_id=<?= $result['id'] ?>" class="btn-sm btn-warning">แก้ไข<i class="fas fa-edit ml-1"></i></a>
                                <button onclick="deleteProduct(<?= $result['id'] ?>)" type="button" class="btn btn-danger btn-sm">ลบ<i class="far fa-trash ml-1"></i></button>
                                <!-- <a type="button" href="../main.php?action=delete_product&product_id=<?= $result['id'] ?>" class="btn-sm btn-danger">ลบ<i class="far fa-trash ml-1"></i></a> -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '_footer.php'; ?>
<script>
    CKEDITOR.replace("type_details")

    $("#addType").submit(function(e) {
        e.preventDefault()
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        var formData = $(this).serialize()
        $.post('../main.php?action=add_type', formData, function(data) {
            if (data.success) {
                swal("แจ้งเตือน", "เพิ่มประเภทสินค้าสำเร็จ", "success").then(function() {
                    location.reload()
                })
            } else {
                swal("แจ้งเตือน", " " + data.msg, "error")
            }
        }, 'json')
    })

    function deleteProduct(id) {
        swal({
                title: "แจ้งเตือน",
                text: "หากลบไปแล้วไม่สามารถกู้คืนได้",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.post('../main.php?action=delete_product', {
                        id: id
                    }, function(data) {
                        if (data.success) {
                            swal("แจ้งเตือน", "สินค้าถูกลบแล้ว", "success").then(function() {
                                location.reload()
                            })
                        } else {
                            swal("แจ้งเตือน", " " + data.msg, "error")
                        }
                    }, 'json')
                }
            });
    }
</script>
</body>

</html>