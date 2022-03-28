<?php include '_header.php'; ?>
<div class="container">
    <div class="card mt-4">
        <div class="card-header form-inline">
            <h4>จัดการสินค้า</h4>
            <a href="product_create.php" type="button" class="btn btn-success ml-auto">เพิ่มสินค้า</a>
        </div>
        <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">รูปภาพสินค้า</th>
                    <th scope="col">ชื่อสินค้า</th>
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
                            <td><?=$i++?></td> 
                            <td>
                                <img src="../uploads/<?=$result['product_image']?>" width="100" alt="">
                            </td>
                            <td><?=$result['product_name']?></td>
                            <td>THB <?=$result['product_price']?></td>
                            <td><?=$result['product_stock']?></td>
                            <td>
                                <a type="button" href="product_edit.php?product_id=<?=$result['id']?>" class="btn-sm btn-warning">แก้ไข</a>
                                <a type="button" href="../main.php?action=delete_product&product_id=<?=$result['id']?>" class="btn-sm btn-danger">ลบ</a>
                            </td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php include '_footer.php'; ?>
</body>
</html>