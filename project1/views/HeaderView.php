<!-- header -->
<header id="header">
<!-- top header -->
<div class="top-header">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6"> <span><i class="fa fa-phone"></i> (04) 6674 2332</span> <span><i class="fa fa-envelope-o"></i> <a href="mailto:support@mail.com">support@mail.com</a></span> </div>
      <?php if(isset($_SESSION['customer_name']) && isset($_SESSION['customer_email']) ): ?>
        <div class="col-xs-12 col-sm-6 col-md-6 customer"> 
          <a href="#"><?php echo $_SESSION['customer_email'] ; ?></a>&nbsp; &nbsp;
          <a href="#"><?php echo $_SESSION['customer_name'] ; ?></a>&nbsp; &nbsp;
          <a href="index.php?controller=account&action=logout">Đăng xuất</a> 
        </div>
      <?php else: ?>
      <div class="col-xs-12 col-sm-6 col-md-6 customer"> 
        <a href="index.php?controller=account&action=login">Đăng nhập</a>&nbsp; &nbsp;<a href="index.php?controller=account&action=register">Đăng ký</a>
       </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<!-- end top header --> 
<!-- middle header -->
<div class="mid-header">
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 logo "> <a href="index.html"> <img src="assets/frontend/100/047/633/themes/517833/assets/logo221b.png?1481775169361" alt="DKT Store" title="DKT Store" class="img-responsive"> </a> </div>
    <div class="col-xs-12 col-sm-12 col-md-6 header-search"> 
      <!--<form method="post" id="frm" action="">-->
      <div style="margin-top:25px;">
        <input type="text" onkeypress="searchForm(event);" value="" placeholder="Nhập từ khóa tìm kiếm..." id="key" class="input-control">
        <button style="margin-top:5px;" type="submit"> <i class="fa fa-search" onclick="return search();"></i> </button>
      </div>
      <!--</form>--> 
      <div class="smart-search">
        <ul>
          <!-- <li><img src="http://localhost:8080/devpro/php60/php60_project/assets/upload/products/1653829638_132195017985165066_1.jpg"><a href="#">Sản phẩm</a></li>
          <li><img src="http://localhost:8080/devpro/php60/php60_project/assets/upload/products/1653829638_132195017985165066_1.jpg"><a href="#">Sản phẩm</a></li>
          <li><img src="http://localhost:8080/devpro/php60/php60_project/assets/upload/products/1653829638_132195017985165066_1.jpg"><a href="#">Sản phẩm</a></li> -->
        </ul>
      </div>
    </div>
    <style type="text/css">
      .header-search{position: relative;}
      .smart-search{position: absolute; width: 100%; background: white; height: 350px; overflow: scroll;z-index: 1; display: none;}
      .smart-search ul{padding: 0px; margin: 0px; list-style: none;}
      .smart-search ul li{border-bottom: 1px solid #dddddd;}
      .smart-search img{width: 70px; margin-right: 5px;}
    </style>
    <script type="text/javascript">
      //khi an phim enter thi nhay den trang tim kiem theo ten
      function searchForm(event){
        //bat phim ener tu ban phim (phim enter co keyCode = 13)
        if(event.keyCode == 13){
          //lay gia tri cua the html co id=key
          let key = document.getElementById("key").value;
          //di chuyen den url tim kiem
          location.href = "index.php?controller=search&action=name&key="+key;
        }
      }
      function search(){
        //lay gia tri cua the html co id=key
        let key = document.getElementById("key").value;
        //di chuyen den url tim kiem
        location.href = "index.php?controller=search&action=name&key="+key;
      }
      //---
      //de thuc hien cac dong code ben duoi thi website can phai load thu vien jquery
      /*
        de kiem tra xem website da load thu vien jquery chua thi thuc hien test bang doan code sau
      */
      //$(document).ready(function(){alert('jquery da duoc load vao trang');});
      $(".input-control").keyup(function(){
        var strKey = $("#key").val();
        if(strKey.trim() == ""){
          $(".smart-search").attr("style","display:none;");
        }else{
          $(".smart-search").attr("style","display:block;");
          //---
          //lay du lieu bang ajax
          $.get("index.php?controller=search&action=ajaxSearch&key="+strKey,function(data){
            //clear cac the li ben trong ul
            $(".smart-search ul").empty();
            //them du lieu vao ul
            $(".smart-search ul").append(data);
          });
          //---
        }
      });
      //---
    </script>
    <?php 
      $numberProduct = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
     ?>
    <div class="col-xs-12 col-sm-12 col-md-3 mini-cart">
      <div class="wrapper-mini-cart"> <span class="icon"><i class="fa fa-shopping-cart"></i></span> <a href="cart"> <span class="mini-cart-count"> <?php echo $numberProduct; ?> </span> sản phẩm <i class="fa fa-caret-down"></i></a>
        <div class="content-mini-cart">
          <div class="has-items">
            <ul class="list-unstyled">
            <?php foreach($_SESSION['cart'] as $product): ?>  
              <li class="clearfix" id="item-1853038">
                <div class="image"> <a href="index.php?controller=products&action=detail&id=<?php echo $product['id']; ?>"> <img alt="<?php echo $product['name']; ?>" src="assets/upload/products/<?php echo $product['photo']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive"> </a> </div>
                <div class="info">
                  <h3><a href="index.php?controller=products&action=detail&id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h3>
                  <p><?php echo $product['number']; ?> x <?php echo number_format(($product['price'] - ($product['price'] * $product['discount'])/100)); ?>₫</p>
                </div>
                <div> <a href="index.php?controller=cart&action=delete&id=<?php echo $product['id']; ?>"> <i class="fa fa-times"></i></a> </div>
              </li>
            <?php endforeach; ?>
            </ul>
            <a href="index.php?controller=cart&action=checkout" class="button">Thanh toán</a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end middle header --> 
<!-- bottom header -->
<div class="bottom-header">
  <div class="container">
    <div class="clearfix">
      <ul class="main-nav hidden-xs hidden-sm list-unstyled">
        <li class="active"><a href="index.php">Trang chủ</a></li>
        <li class="has-submenu"> <a href="#"> <span>Sản phẩm</span><i class="fa fa-caret-down" style="margin-left: 5px;"></i> </a>
          <ul class="list-unstyled level1">
            <?php 
              //co the ket noi csdl de truy van o day
              $conn = Connection::getInstance();
              $query = $conn->query("select * from categories where parent_id = 0 order by id desc");
              $categories = $query->fetchAll(PDO::FETCH_OBJ);
             ?>
             <?php foreach($categories as $rows): ?>
            <li><a href="index.php?controller=products&action=category&id=<?php echo $rows->id; ?>"><?php echo $rows->name; ?></a></li>
            <?php 
              $querySub = $conn->query("select * from categories where parent_id = {$rows->id} order by id desc");
              $categoriesSub = $querySub->fetchAll(PDO::FETCH_OBJ);
             ?>
             <?php foreach($categoriesSub as $rowsSub): ?>
            <li style="padding-left:20px;"><a href="index.php?controller=products&action=category&id=<?php echo $rowsSub->id; ?>"><?php echo $rowsSub->name; ?></a></li>
              <?php endforeach; ?>
            <?php endforeach; ?>
          </ul>
        </li>
        <li><a href="index.php?controller=cart">Giỏ hàng</a></li>
        <li><a href="index.php?controller=news">Tin tức</a></li>
        <li><a href="index.php?controller=contact">Liên hệ</a></li>
      </ul>
      <a href="javascript:void(0);" class="toggle-main-menu hidden-md hidden-lg"> <i class="fa fa-bars"></i> </a>
     
    </div>
  </div>
</div>
<!-- end bottom header -->
</header>
<!-- end header -->