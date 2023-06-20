<?php 
    //load file layout vao day
    self::$fileLayout = "LayoutTrangTrong.php";
 ?>
<?php 
  //lay so sao cua san pham co id truyen vao
    function modelGetStar($product_id,$star){
      //lay bien ket noi csdl
      $conn = Connection::getInstance();
      $query = $conn->query("select id from rating where product_id=$product_id and star=$star");
      //tra ve so luong ban ghi
      return $query->rowCount();
    }
 ?>
 <div class="top">
    <div class="row">
      <div class="col-xs-12 col-md-6 product-image">
        <div class="featured-image"> 
          <img src="assets/upload/products/<?php echo $record->photo; ?>" style="width: 100%;" class="img-responsive"/>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 info">
        <h1 itemprop="name"><?php echo $record->name; ?></h1>
        <p class="vendor"> Category:&nbsp; <span> 
            <?php 
                $conn = Connection::getInstance();
                $queryCategory = $conn->query("select name from categories where id = {$record->category_id}");
                $category = $queryCategory->fetch(PDO::FETCH_OBJ);
                echo isset($category->name) ? $category->name : "";
             ?>
         </span></p>
        <p itemprop="price" class="price-box product-price-box"> <span class="special-price"> <span class="price product-price" style="text-decoration:line-through;"> <?php echo number_format($record->price); ?>₫ </span></span></p>
        <p itemprop="price" class="price-box product-price-box"> <span class="special-price"> <span class="price product-price"> <?php echo number_format($record->price - $record->price * $record->discount/100); ?>₫ </span></span></p>
      </p>
      <a href="index.php?controller=cart&action=create&id=<?php echo $record->id; ?>" class="btn btn-primary">Cho vào giỏ hàng</a>
      <!-- rating -->
      <div style="border:1px solid #dddddd; margin-top: 15px;">
        <h4 style="padding-left: 10px;">Rating</h4>
        <table style="width: 100%;">
          <tr>
            <td style="width: 80%; padding-left: 10px;"><a href="index.php?controller=products&action=rating&id=<?php echo $record->id; ?>&star=1"><img src="assets/frontend/images/star.jpg"></a></td>


            <td><span class="label label-primary"><?php echo modelGetStar($record->id,1); ?> vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><a href="index.php?controller=products&action=rating&id=<?php echo $record->id; ?>&star=2"><img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"></a></td>
            <td><span class="label label-warning"><?php echo modelGetStar($record->id,2); ?> vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><a href="index.php?controller=products&action=rating&id=<?php echo $record->id; ?>&star=3"><img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"></a></td>
            <td><span class="label label-danger"><?php echo modelGetStar($record->id,3); ?> vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><a href="index.php?controller=products&action=rating&id=<?php echo $record->id; ?>&star=4"><img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"></a></td>
            <td><span class="label label-info"><?php echo modelGetStar($record->id,4); ?> vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><a href="index.php?controller=products&action=rating&id=<?php echo $record->id; ?>&star=5"><img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"> <img src="assets/frontend/images/star.jpg"></a></td>
            <td><span class="label label-success"><?php echo modelGetStar($record->id,5); ?> vote</span></td>
          </tr>
        </table>
        <br>
      </div>
      <!-- /rating -->
    </div>
  </div>
</div>
<div class="middle" style="margin-top:20px;">
  <!-- chi tiet -->
  <?php echo $record->description; ?>
  <?php echo $record->content; ?>
  <!-- chi tiet -->

</div>