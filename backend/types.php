<?php include '_header.php'; ?>
<div class="container">
    <div class="card mt-4">
        <div class="card-header form-inline">
            <h4>จัดการประเภทสินค้า</h4>
            <a type="button" class="btn btn-primary ml-auto modal-lg" data-toggle="modal" data-target="#addproduct_types" data-whatever="@mdo">เพิ่มประเภทสินค้า</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ประเภทสินค้า</th>
                        <th scope="col" class="w-50">รายละเอียด</th>
                        <th scope="col">จัดการประเภทสินค้า</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $sql = "SELECT * FROM product_types"; // คำสั่ง SQL
                    $query = $conn->query($sql); // การ Query SQL
                    while ($result = mysqli_fetch_assoc($query)) { // การลูปข้อมูลมาแสดง
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $result['type_name'] ?></td>
                            <td><?= $result['type_details'] ?></td>
                            <td class="pl-4">
                                <a type="button" href="type_edit.php?type_id=<?= $result['type_id'] ?>" class="btn-sm btn-warning">แก้ไข<i class="fas fa-edit ml-1"></i></a>
                                <button onclick="deleteType(<?= $result['type_id'] ?>)" type="button" class="btn btn-danger btn-sm">ลบ<i class="far fa-trash ml-1"></i></button>
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
    $("#addType").submit(function(e) {
        e.preventDefault()
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

    function deleteType(id) {
        swal({
                title: "แจ้งเตือน",
                text: "หากลบไปแล้วไม่สามารถกู้คืนได้",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.post('../main.php?action=delete_type', {
                        id: id
                    }, function(data) {
                        if (data.success) {
                            swal("แจ้งเตือน", "ประเภทสินค้าถูกลบแล้ว", "success").then(function() {
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