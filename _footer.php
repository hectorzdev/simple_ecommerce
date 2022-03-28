
<div class="footer">
    <div class="container">
        <div class="py-2 text-center text-white">
            Copyright © 2022 , ishoope.com
        </div>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">เข้าสู่ระบบ</h5>
          <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#registerModal">สมัครสมาชิก</button>
        </div>
        <div class="modal-body">
            <form action="main.php?action=login" method="POST" >
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-door-open"></i> เข้าสู่ระบบ</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>


<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">สมัครสมาชิก</h5>
        </div>
        <div class="modal-body">
            <form action="main.php?action=register" method="POST">
                <div class="form-group">
                    <label >Email address</label>
                    <input type="email" name="email" class="form-control" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label >Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>ยืนยันรหัสผ่าน</label>
                    <input type="password" name="con_password" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
<div id="nav-overlay" onclick="closeBar()"></div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script>

    function addCart(id){
      $.post("main.php?action=addCart&product_id="+id , function(data){
          $('.cart').html(data)
          swal("แจ้งเตือน" , 'เพิ่มสินค้าลงตะกร้าสำเสร็จ' , "success")
      }, 'json')
    }

    function testAjax(){
        $.post("main.php?action=testAjax", { price:500 , amount:12 } ,   function(data){
            swal("ราคา" , " "+data.total , "success")
        }, 'json')
    }

    function openNav(){
        var nav = document.getElementById('mobile-nav')
        var overlay = document.getElementById('nav-overlay')
        nav.style.left = "0";
        overlay.style.display = "block"
    }

    function closeBar(){
        var nav = document.getElementById('mobile-nav')
        var overlay = document.getElementById('nav-overlay')
        nav.style.left = "-500px";
        overlay.style.display = "none"
    }
</script>