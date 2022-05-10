<?php
session_start();
include 'connection.php';


$action = $_GET['action'];

switch ($action) {

    case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
        $query = $conn->query($sql);
        $result = $query->num_rows;
        if ($result >= 1) {
            $row = mysqli_fetch_assoc($query);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['position'] = $row['position'];
            header('location: index.php');
        } else {
?>
            <script>
                alert('เข้าสู่ระบบไม่สำเร็จ');
                window.location = 'index.php';
            </script>
        <?php return false;
        }
        break;

    case 'logout':
        session_destroy();
        header("location: index.php");
        break;

    case 'register':

        $email = $_POST['email'];
        $password = $_POST['password'];
        $con_password = $_POST['con_password'];

        if ($password != $con_password) {
        ?>
            <script>
                alert('รหัสผ่านไม่ตรงกัน');
                window.location = 'index.php';
            </script>
        <?php
            return false;
        }

        $sql = "INSERT INTO `users`( `email`, `password`) VALUES ('$email','$password')";
        $insert = $conn->query($sql);
        if ($insert == true) {
            header('location: index.php');
        } else { ?>
            <script>
                alert('สมัครสมาชิกไม่สำเร็จ');
                window.location = 'index.php';
            </script>

        <?php return false;
        }

        break;

    case 'add_product':
        try {
            $type_id = $_POST['type_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_stock = $_POST['product_stock'];
            $product_details = $_POST['product_details'];

            $target_dir = "uploads/"; // พื้นที่สำหรับอัพโหลดไฟล์
            $target_file = $target_dir . basename($_FILES['product_image']['name']);
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $filename  = rand() . '_' . time();

            $temp = explode(".", $_FILES["product_image"]["name"]);
            $newfilename = round(microtime(true)) . '_' . time() . '.' . end($temp);
            $upload = move_uploaded_file($_FILES['product_image']['tmp_name'], "uploads/" . $newfilename);


            if (!$upload) {
                throw new Exception("อัพรูปไม่สำเร็จ");
            }

            $sql = "INSERT INTO `products`(`type_id`, `product_name`, `product_price`, `product_stock`, `product_image`, `product_details`) 
                VALUES ('$type_id','$product_name','$product_price','$product_stock','$newfilename','$product_details')";

            $query = $conn->query($sql);

            if (!$query) {
                throw new Exception("อัพข้อมูลลงฐานข้อมูลไม่สำเร็จ");
            }

            $data['success'] = true;
        } catch (Exception $th) {
            $data['success'] = false;
            $data['msg'] = $th->getMessage();
        }
        echo json_encode($data);
        break;

    case 'add_type':
        try {
            $type_name = $_POST['type_name'];
            $type_details = $_POST['type_details'];

            $sql = "INSERT INTO `product_types`(`type_name`, `type_details`) VALUES ('$type_name','$type_details')";
            $query = $conn->query($sql);

            $data['success'] = true;
        } catch (Exception $th) {
            $data['success'] = false;
            $data['msg'] = $th->getMessage();
        }
        echo json_encode($data);
        break;

    case 'delete_product':
        try {
            $id = $_POST['id'];
            $sql = "SELECT * FROM products WHERE id = '$id'";
            $query = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($query);
            $path = 'uploads/' . $result['product_image'];

            if (!unlink($path)) {
                throw new Exception("ไม่สามารถลบรูปภาพได้");
            }

            $sql = "DELETE FROM `products` WHERE id = '$id'";
            $delete = $conn->query($sql);

            if (!$delete) {
                throw new Exception("ขออภัย, ไม่สามารถลบสินค้าได้");
            }

            $data['success'] = true;
        } catch (Exception $th) {
            $data['success'] = false;
            $data['msg'] = $th->getMessage();
        }
        echo json_encode($data);

        break;

    case 'delete_type':
        try {
            $type_id = $_POST['id'];
            $sql = "SELECT * FROM product_types WHERE type_id = '$type_id'";
            $query = mysqli_query($conn, $sql);

            $del = "DELETE FROM `product_types` WHERE type_id = '$type_id'";
            $qdelete = $conn->query($del);

            if (!$qdelete) {
                throw new Exception("ขออภัย, ไม่สามารถลบประเภทสินค้าได้");
            }

            $data['success'] = true;
        } catch (Exception $th) {
            $data['success'] = false;
            $data['msg'] = $th->getMessage();
        }
        echo json_encode($data);

        break;

    case 'delete_image':
        try {
            $id = $_POST['id'];

            $sql = "SELECT * FROM product_images WHERE id = '$id'";
            $query = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($query);
            $path = 'uploads/' . $result['product_image'];

            if (!unlink($path)) {
                throw new Exception("ไม่สามารถลบรูปภาพได้");
            }

            $del = "DELETE FROM product_images WHERE id = '$id'"; // ลบข้อมูลจาก ID
            $qdel = mysqli_query($conn, $del);

            if (!$qdel) {
                throw new Exception("ขออภัย, ลบรูปภาพจากฐานข้อมูลไม่สำเร็จ");
            }

            // $pid = $_GET['pid'];
            // $image = $_GET['image'];
            // $path = 'uploads/' . $_GET['image'];
            // $sql = "DELETE FROM `product_images` WHERE product_image = '$image'";
            // $query = $conn->query($sql);


            $data['success'] = true;
        } catch (Exception $th) {
            $data['success'] = false;
            $data['msg'] = $th->getMessage();
        }
        echo json_encode($data);
        break;

    case 'update_product':
        try {
            $id = $_POST['product_id'];
            $product_name =  $_POST['product_name'];
            $product_price =  $_POST['product_price'];
            $product_stock =  $_POST['product_stock'];
            $product_details = $_POST['product_details'];
            $type_id = $_POST['type_id'];

            if ($_FILES['product_image']['size'] > 0) {

                $target_dir = "uploads/"; // พื้นที่สำหรับอัพโหลดไฟล์
                $target_file = $target_dir . basename($_FILES['product_image']['name']);
                $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $filename  = rand() . '_' . time();

                $temp = explode(".", $_FILES["product_image"]["name"]);
                $newfilename = round(microtime(true)) . '_' . time() . '.' . end($temp);
                $upload = move_uploaded_file($_FILES['product_image']['tmp_name'], "uploads/" . $newfilename);

                $sql = "UPDATE `products` SET `type_id`='$type_id', `product_name`='$product_name',`product_price`='$product_price',`product_stock`='$product_stock',`product_image` = '$newfilename',`product_details` = '$product_details'
                    WHERE id = '$id'";
            } else {
                $sql = "UPDATE `products` SET `type_id`='$type_id', `product_name`='$product_name',`product_price`='$product_price',`product_stock`='$product_stock',`product_details` = '$product_details' WHERE id = '$id'";
            }
            $query = mysqli_query($conn, $sql);

            if (!$query) {
                throw new Exception("อัพเดทข้อมูลไม่สำเร็จ");
            }


            $data['success'] = true;
        } catch (Exception $th) {
            $data['success'] = false;
            $data['msg'] = $th->getMessage();
        }
        echo json_encode($data);

        break;

    case 'update_type':
        try {
            $type_id = $_POST['type_id'];
            $type_name =  $_POST['type_name'];
            $type_details =  $_POST['type_details'];

            $sql = "UPDATE `product_types` SET `type_name`='$type_name',`type_details`='$type_details'
                    WHERE type_id = '$type_id'";

            $query = mysqli_query($conn, $sql);

            if (!$query) {
                throw new Exception("อัพเดทข้อมูลไม่สำเร็จ");
            }


            $data['success'] = true;
        } catch (Exception $th) {
            $data['success'] = false;
            $data['msg'] = $th->getMessage();
        }
        echo json_encode($data);

        break;

    case 'addCart':

        $product_id = $_GET['product_id'];
        $newcart = ['product_id' => $product_id, 'amount' => 1];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        array_push($_SESSION['cart'], $newcart);
        echo json_encode(count($_SESSION['cart']));
        break;

    case 'testAjax':
        $price = $_POST['price'];
        $amount = $_POST['amount'];
        $total = $price * $amount;

        if ($total >= 5000) {
            $discount = $total * 0.20;
            $total = $total - $discount;
        } else {
            $discount = $total * 0.10;
            $total = $total - $discount;
        }
        $export = ['total' => $total, 'amount' => $amount];
        echo json_encode($export);
        break;

    case 'removeCart':
        $key = $_GET['key'];
        unset($_SESSION['cart'][$key]);
        header('location: cart.php');
        break;

    case 'amountCart':

        $amount = $_POST['amount'];
        $key = $_POST['key'];
        $_SESSION['cart'][$key]['amount'] = $amount;

        $carts = $_SESSION['cart'];
        $total = 0;
        foreach ($carts as $key => $cart) {
            $product_id = $cart['product_id'];
            $amount = $cart['amount'];
            $sql = "SELECT  * FROM `products` WHERE id = $product_id";
            $query = $conn->query($sql);
            $result = mysqli_fetch_assoc($query);
            $product_price = $result['product_price'];
            $total += $product_price * $amount;
        }

        $export = ['total' => $total, 'amount' => $amount];

        echo json_encode($export);

        break;


    case 'checkout':



        try {

            if (!isset($_SESSION['user_id'])) {
                throw new Exception("ขออภัย , กรุณาเข้าสู่ระบบก่อนสั่งซื้อ", 1);
            }

            $address = $_POST['address'];
            $user_id = $_SESSION['user_id'];
            $sql = "INSERT INTO orders (`user_id` , `address`) VALUES ('$user_id' , '$address')";
            $insert = $conn->query($sql);
            $order_id = $conn->insert_id;
            if (!$insert) {
                throw new Exception("ขออภัย , บันทึกข้อมูลสั่งซื้อไม่สำเร็จ", 1);
            }

            foreach ($_SESSION['cart'] as $key => $cart) {
                $product_id = $cart['product_id'];
                $amount = $cart['amount'];
                $sql = "INSERT INTO order_details (`order_id` , `product_id` , `amount`) VALUES ('$order_id' , '$product_id' , '$amount')";
                $query = $conn->query($sql);
            }

            unset($_SESSION['cart']);

        ?>
            <script>
                alert('สั่งซื้อสินค้าสำเร็จ');
                window.location = 'order_history.php';
            </script>
        <?php
        } catch (Exception $e) {
        ?>
            <script>
                alert('<?= $e->getMessage() ?>');
                window.location = 'cart.php';
            </script>
<?php
        }

        break;

    case 'upload_product_images':
        try {
            $product_id = $_POST['product_id'];
            $count = count($_FILES['product_images']['name']);

            for ($i = 0; $i < $count; $i++) {

                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES['product_images']['name'][$i]);
                $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $filename  = rand() . '_' . time();

                $temp = explode(".", $_FILES["product_images"]["name"][$i]);
                $newfilename = rand() . '_' . time() . '.' . end($temp);
                $upload = move_uploaded_file($_FILES['product_images']['tmp_name'][$i], "uploads/" . $newfilename);

                $sql = "INSERT INTO product_images (`product_id` , `product_image`) VALUES ('$product_id' , '$newfilename')";
                $query = mysqli_query($conn, $sql);
            }
            if (!$query) {
                throw new Exception("เพิ่มรูปภาพไม่สำเร็จ");
            }

            $data['success'] = true;
        } catch (Exception $th) {
            $data['success'] = false;
            $data['msg'] = $th->getMessage();
        }
        echo json_encode($data);
        break;


    case 'changeStatus':

        $status =  $_GET['status'];
        $oid =  $_GET['oid'];

        $sql = "UPDATE `orders` SET `status`= '$status' WHERE id = $oid";
        $query = $conn->query($sql);
        if ($query) {
            $status = true;
        } else {
            $status = false;
        }

        echo json_encode($status);
        break;


    default:
        # code...
        break;
}


?>