<?php include '_header.php'; ?>
<div class="container">
        <div class="card my-4">
            <div class="card-header form-inline">
                <h4>จัดการคำสั่งซื้อ</h4>
            </div>
            <div class="card-body">
            <table class="table" id="dataTable">
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
                        $sql = "SELECT users.email , orders.* FROM orders LEFT JOIN users ON users.id = orders.user_id ORDER BY created_at DESC";
                        $query = $conn->query($sql);
                        while ($result  = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?=$i++?></td>
                            <td><?=$result['email']?></td>
                            <td>
                                <select  class="form-control" onchange="changeStatus(this.value , <?=$result['id']?>)">
                                    <option <?=$result['status'] == 0 ? 'selected' : '' ?> value="0">รอการจัดส่ง</option>
                                    <option <?=$result['status'] == 1 ? 'selected' : '' ?> value="1">จัดส่งสำเร็จ</option>
                                </select>
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#dataTable').dataTable()
    })

    function changeStatus(status , id){
        $.post('../main.php?action=changeStatus&oid='+id+'&status='+status , function(data){
            if(data){
                swal('แจ้งเตือน' , "แก้ไขสถานะสำเร็จ" , "success").then(function(){
                    location.reload()
                })
            }else{
                swal('แจ้งเตือน' , "แก้ไขสถานะไม่สำเร็จ" , "error")
            }
        })
    }
</script>
</body>
</html>