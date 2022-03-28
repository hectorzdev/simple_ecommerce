<?php 
    include '_header.php';
?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-left">สินค้าทั้งหมด</h4>
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
                        <!-- <a href="main.php?action=addCart&product_id=<?=$result['id']?>"><button><i class="fas fa-shopping-cart"></i></button></a> -->
                        <button onclick="addCart(<?=$result['id']?>)"><i class="fas fa-shopping-cart"></i></button>
                        <div class="img-product" style="background-image: url(uploads/<?=$result['product_image']?>);" ></div>
                    </div>
                    <p class="mt-2  mb-0"><?=$result['product_name']?></p>
                    <span>ราคา <?=$result['product_price']?></span>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<?php  include '_footer.php'; ?>
<script>
    
    

</script>
</body>
</html>