 
<?php 

    self::$fileLayout = "LayoutTrangTrong.php";
 ?>
 <!-- main -->
        
        <div class="template-cart">
          <form action="index.php?controller=cart&action=update" method="post">
            <div class="table-responsive">
              <table class="table table-cart">
                <thead>
                  <tr>
                    <th class="image">Ảnh sản phẩm</th>
                    <th class="name">Tên sản phẩm</th>
                    <th class="price">Giá bán lẻ</th>
                    <th class="quantity">Số lượng</th>
                    <th class="price">Thành tiền</th>
                    <th>Xóa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($_SESSION['cart'] as  $value): ?>
                  <tr>
                    <td><img src="<?php echo $value["photo"]; ?>" class="img-responsive" /></td>
                    <td><a href="index.php?controller=products&action=detail&id=<?php echo $value["id"]; ?>"><?php echo $value["name"]; ?></a></td>
                    <td> <?php echo number_format ($value["price"]); ?>₫ </td>
                    <td><input type="number" id="qty" min="1" class="input-control" value="<?php echo $value["number"]; ?>" name="product_<?php echo $value["id"];  ?>" required="Không thể để trống"></td>
                    <td><p><b><?php echo number_format ($value["price"] - $value["price"] * $value["discount"]); ?> ₫</b></p></td>
                    <td><a href="index.php?controller=cart&action=delete&id=<?php echo $value["id"]; ?>" data-id="2479395"><i class="fa fa-trash"></i></a></td>
                  </tr>
               <?php endforeach; ?>
                </tbody>

                <?php 
                // gọi hàm trong model
                 if ((new CartController())->cartNumber()): ?>
                <tfoot>
                  <tr>
                    <td colspan="6"><a href="index.php?controller=cart&action=destroy" class="button pull-left">Xóa toàn bộ</a> <a href="index.php" class="button pull-right black">Tiếp tục mua hàng</a>
                      <input type="submit" class="button pull-right" value="Cập nhật"></td>
                  </tr>
                <?php endif; ?>
                </tfoot>
              </table>
            </div>
          </form>
          <?php if ((new CartController())->cartNumber()):  ?>
          <div class="total-cart"> Tổng tiền thanh toán:
           <?php echo number_format ((new CartController())->cartTotal()) ; ?>₫  <br>
            <a href="index.php?controller=cart&action=checkout" class="button black">Thanh toán</a> 
          </div>
        <?php endif; ?>
        </div>
        
        <!-- end main --> 