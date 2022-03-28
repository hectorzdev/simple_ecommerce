<?php include '_header.php'; ?>
<div class="container">
        <div class="card my-4">
            <div class="card-header form-inline">
                <h4>ประวัติการสั่งซื้อ</h4>
            </div>
            <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ผู้สั่งซื้อ</th>
                        <th scope="col">สถานะคำสั่งซื้อ</th>
                        <th scope="col">ที่อยู่ในการจัดส่ง</th>
                        <th scope="col">วันที่สั่งซื้อ</th>
                        <th scope="col">ดูคำสั่งซื้อ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT users.email , orders.* FROM orders LEFT JOIN users ON users.id = orders.user_id WHERE user_id = $user_id";
                        $query = $conn->query($sql);
                        while ($result  = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?=$i++?></td>
                            <td><?=$result['email']?></td>
                            <td>
                                <?php if($result['status']  == '0'){ ?>
                                    <strong class="text-warning">รอการจัดส่ง</strong>
                                <?php }else{ ?>
                                    <strong class="text-success">จัดส่งสำเร็จ</strong>
                                <?php } ?>
                                
                            </td>
                            <td><?=$result['address']?></td>
                            <td><?=$result['created_at']?></td>
                            <td>
                                <a type="button" href="order_details.php?oid=<?=$result['id']?>" class="btn btn-sm btn-info">ดูคำสั่งซื้อ</a>
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