<?php include '_header.php'; ?>

<div class="container bg-white py-5">
    <nav aria-label="breadcrumb" class="my-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
            <li class="breadcrumb-item active" aria-current="page">รายละเอียดสินค้า</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-6">
            <div class="img-product-detail" style="background-image: url(https://5.imimg.com/data5/HG/DL/IU/SELLER-45295496/brown-half-sleeve-shirt-500x500.jpg);" ></div>
        </div>
        <div class="col-md-6">
            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h3>
            <h5 class="text-danger">590.00 THB</h5>
            <h4 class="mt-3">รายละเอียดสินค้า</h4>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                Ducimus illum magnam cupiditate officiis asperiores deleniti ullam nam beatae ipsum illo, sunt nihil libero vero odit sint ad fuga quis in.</p>
            <div class="row">
                <div class="col-md-6">
                    <input type="number" name="amount_product" placeholder="จำนวนสินค้า" id="" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary w-100">เพิ่มลงตะกร้า</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <h4 class="text-left">สินค้าโปรโมชั่น</h4>
        </div>
        <div class="col-lg-6 text-right">
            <a href="" class="all-product-btn">สินค้าทั้งหมด <i class="fa fa-arrow-right"></i></a>  
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-6 col-lg-3 mb-4">
            <div class="item-shop">
                <div class="for-img-product">
                    <button><i class="fas fa-shopping-cart"></i></button>
                    <div class="img-product" style="background-image: url(https://5.imimg.com/data5/HG/DL/IU/SELLER-45295496/brown-half-sleeve-shirt-500x500.jpg);" ></div>
                </div>
                <p class="mt-2  mb-0">Morning of the Earth Essential T-Shirt</p>
                <span>by livingtomatoes</span>
            </div>
        </div>
        <div class="col-6 col-lg-3 mb-4">
            <div class="item-shop">
                <div class="for-img-product">
                    <button><i class="fas fa-shopping-cart"></i></button>
                    <div class="img-product" style="background-image: url(https://static-01.daraz.pk/p/50a541599a58d48df4d7ed82fa058b37.jpg);" ></div>
                </div>
                <p class="mt-2  mb-0">Morning of the Earth Essential T-Shirt</p>
                <span>by livingtomatoes</span>
            </div>
        </div>
        <div class="col-6 col-lg-3 mb-4">
            <div class="item-shop">
                <div class="for-img-product">
                    <button><i class="fas fa-shopping-cart"></i></button>
                    <div class="img-product" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS19BCBWLUB9I8k4KQ-io2Q_v2nkRuU5hjp1NWw-YvHPqBzk5EhneEiDajl5MeZShvJaOU&usqp=CAU);" ></div>
                </div>
                <p class="mt-2  mb-0">Morning of the Earth Essential T-Shirt</p>
                <span>by livingtomatoes</span>
            </div>
        </div>
        <div class="col-6 col-lg-3 mb-4">
            <div class="item-shop">
                <div class="for-img-product">
                    <button><i class="fas fa-shopping-cart"></i></button>
                    <div class="img-product" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRkksJBl5XvZ_yQSdh2FW-Lmw5Ya6jUp-QItsMo5vCU4xNEmt3in4luxPlv4i_mRtIhN0&usqp=CAU);" ></div>
                </div>
                <p class="mt-2  mb-0">Morning of the Earth Essential T-Shirt</p>
                <span>by livingtomatoes</span>
            </div>
        </div>
    </div>
</div>


<?php include '_footer.php'; ?>
</body>
</html>