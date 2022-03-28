<?php include '_header.php'; ?>
<div class="container">
        <div class="card my-4">
            <div class="card-header form-inline">
                <h4>คำสั่งซื้อ</h4>
            </div>
            <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">รูปภาพสินค้า</th>
                        <th scope="col">ชื่อสินค้า</th>
                        <th scope="col">จำนวน</th>
                        <th scope="col">ราคารวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        $oid = $_GET['oid'];
                        $sql = "SELECT order_details.amount , order_details.product_id , products.product_price , products.product_name , products.product_image ,  orders.* FROM `orders` 
                        LEFT JOIN order_details ON orders.id = order_details.order_id
                        LEFT JOIN products ON products.id = order_details.product_id
                        WHERE orders.id = $oid;";
                        $query = $conn->query($sql);
                        while ($result  = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?=$i++?></td>
                            <td>
                                <img src="uploads/<?=$result['product_image']?>" width="150" alt="">
                            </td>
                            <td><?=$result['product_name']?></td>
                            <td><?=$result['amount']?></td>
                            <td><?=number_format($result['amount'] * $result['product_price'] , 2)?></td>
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