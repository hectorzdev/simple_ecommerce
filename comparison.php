<?php
include '_header.php';
?>
<div class="container py-5">
    <form action="comparison.php" method="get">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="text-left">เปรียบเทียบสินค้า</h4>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">เปรียบเทียบ<i class="fas fa-arrow-alt-right ml-1"></i></button>
            </div>
            <div class="col-lg-12">
                <hr>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 form-group">
                <label for="product_1">เลือกสินค้าชิ้นแรก</label>
                <select name="product_1" id="product_1" class="form-control" required>
                    <option disabled selected value="">เลือก</option>
                    <?php
                    $sql = "SELECT * FROM products";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $row['id'] ?>"><?php echo $row['product_name'] ?> (<?php echo number_format($row['product_price']) ?>฿)
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label for="product_2">เลือกสินค้าชิ้นที่สอง</label>
                <select name="product_2" id="product_2" class="form-control" required>
                    <option disabled selected value="">เลือก</option>
                    <?php
                    $sql = "SELECT * FROM products";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $row['id'] ?>"><?php echo $row['product_name'] ?> (<?php echo number_format($row['product_price']) ?>฿)</option>
                    <?php } ?>
                </select>
            </div>

        </div>
    </form>


    <div class="row">
        <?php
        if (isset($_GET['product_1'])) { ?>
            <?php
            $id = $_GET['product_1'];
            $sql = "SELECT * FROM products WHERE id = '$id'";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-6 text-center">
                    <img src="uploads/<?= $row['product_image'] ?>" style="width: 400px; height: 350px;" class="mb-3 " alt="">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">ชื่อสินค้า</th>
                                <td><?= $row['product_name'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">ราคา</th>
                                <td><?= number_format($row['product_price']) ?> บาท</td>
                            </tr>
                            <tr>
                                <th scope="row">จำนวน</th>
                                <td><?= $row['product_stock'] ?> ชื้น</td>
                            </tr>
                            <tr>
                                <th scope="row">รายละเอียด</th>
                                <td><?= $row['product_details'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        <?php } ?>

        <?php
        if (isset($_GET['product_2'])) { ?>
            <?php
            $id = $_GET['product_2'];
            $sql = "SELECT * FROM products WHERE id = '$id'";
            $query = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-6 text-center">
                    <img src="uploads/<?= $row['product_image'] ?>" style="width: 400px; height: 350px;" class="mb-3" alt="">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">ชื่อสินค้า</th>
                                <td><?= $row['product_name'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">ราคา</th>
                                <td><?= number_format($row['product_price']) ?> บาท</td>
                            </tr>
                            <tr>
                                <th scope="row">จำนวน</th>
                                <td><?= $row['product_stock'] ?> ชื้น</td>
                            </tr>
                            <tr>
                                <th scope="row">รายละเอียด</th>
                                <td><?= $row['product_details'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        <?php } ?>

        <?php include '_footer.php'; ?>
        </body>

        </html>