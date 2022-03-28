<?php include '_header.php'; ?>

    <div class="container">
        <div class="row mb-5">
            <div class="col-12 mt-5 mb-4">
                <h3>รายการสั่งซื้อของฉัน</h3>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">รูปสินค้า</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                    <th scope="col">ราคาสินค้า</th>
                                    <th scope="col">จำนวน</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $price = 0;
                                if(isset($_SESSION['cart'])){
                                foreach ($_SESSION['cart'] as $key => $cart) { 
                                $product_id = $cart['product_id'];
                                $sql = "SELECT  * FROM `products` WHERE id = $product_id";
                                $query = $conn->query($sql);
                                $result = mysqli_fetch_assoc($query);

                                $price += $result['product_price'] * $cart['amount'];
                                ?>
                                <tr>
                                    <th scope="col">
                                        <img src="uploads/<?=$result['product_image']?>" width="70"  alt="">
                                    </th>
                                    <th scope="col"><?=$result['product_name']?> </th>
                                    <th scope="col"><?=$result['product_price']?> / ชิ้น</th>
                                    <th scope="col">
                                        <button type="button" onclick="amount('minus' , <?=$key?> , <?=$result['product_price']?>)" class="btn btn-sm btn-danger">ลบ</button>   
                                        <span id="amount_<?=$key?>" class="mx-2"><?=$cart['amount']?></span>
                                        <button type="button" onclick="amount('plus', <?=$key?> , <?=$result['product_price']?>)" class="btn btn-sm btn-warning">เพิ่ม</button> 
                                    </th>
                                    <td>
                                        <a href="main.php?action=removeCart&key=<?=$key?>">
                                            <button class='btn btn-sm btn-outline-danger'>ลบ</button>
                                        </a>    
                                    </td>
                                </tr>                       
                               <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="border bg-light rounded p-4">
                <div class="form-inline">
                    <h6>รวมราคาทั้งหมด:</h3>
                    <h6 class="ml-auto" id="total"><?=$price?></h6>
                </div>
                <br>
                <form class="was-validated" action="main.php?action=checkout" method="POST">
                <div class="mb-3">
                    <label for="validationTextarea">ที่อยู่</label>
                    <textarea class="form-control is-invalid" name="address" id="validationTextarea" placeholder="กรุณากรอกที่อยู่" required></textarea>
                    <div class="invalid-feedback">
                    โปรดกรอกที่อยู่สำหรับการจัดส่ง
                    </div>
                </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block">ยืนยันคำสั่งซื้อ</button>
                </form>
               </div>
           </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="text-left">สินค้าแนะนำ</h4>
            </div>
            <div class="col-lg-6 text-right">
                <a href="" class="all-product-btn">สินค้าทั้งหมด <i class="fa fa-arrow-right"></i></a>  
            </div>
        </div>
        
        <div class="row mt-4">
            <?php 
                $i = 1;
                $sql = "SELECT * FROM products"; // คำสั่ง SQL
                $query = $conn->query($sql); // การ Query SQL
                while ($result = mysqli_fetch_assoc($query)) { // การลูปข้อมูลมาแสดง
            ?>
                <div class="col-6 col-lg-3 mb-4">
                    <div class="item-shop">
                        <div class="for-img-product">
                        <button onclick="addCartRecom(<?=$result['id']?>)"><i class="fas fa-shopping-cart"></i></button>
                            <div class="img-product" style="background-image: url(uploads/<?=$result['product_image']?>);" ></div>
                        </div>
                        <p class="mt-2  mb-0"><?=$result['product_name']?></p>
                        <span>ราคา <?=$result['product_price']?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


<?php include '_footer.php'; ?>
<script>

    function addCartRecom(id){
      $.post("main.php?action=addCart&product_id="+id , function(data){
          $('.cart').html(data)
          swal("แจ้งเตือน" , 'เพิ่มสินค้าลงตะกร้าสำเสร็จ' , "success").then(function(){
              location.reload()
          })
      }, 'json')
    }
    

    function amount(type , key , price){
        var amount = $('#amount_'+key).text() // #('#amount_15')
        var absolute_amount = parseInt(amount)
        if(type == 'plus'){
            absolute_amount++
        }else{
            if(absolute_amount > 1){
                absolute_amount--
            } 
        }
        $('#amount_'+key).text(absolute_amount)
        $.post('main.php?action=amountCart' , {price:price , amount:absolute_amount , key:key} , function(data){
            $("#total").text(data.total)
        }, 'json')
    }
</script>
</body>
</html>