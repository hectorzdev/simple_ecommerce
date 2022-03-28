<?php 
    include '_header.php';
?>
<div id="carouselExampleControls" class="carousel slide sm-d-none" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/img/slide-1.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="assets/img/slide-1.png" class="d-block w-100" alt="...">
      </div>
    </div>
   <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-left">สินค้าทั้งหมด</h4>
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