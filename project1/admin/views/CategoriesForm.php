<?php 
	//load file layout vao day
	self::$fileLayout = "LayoutView.php";
 ?>
 <div class="col-md-12">  
    <div class="panel panel-primary">
        <div class="panel-heading">Add edit category</div>
        <div class="panel-body">
        <form method="post" action="<?php echo $action; ?>">
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Name</div>
                <div class="col-md-10">
                    <input type="text" value="<?php echo isset($record->name)?$record->name:''; ?>" name="name" class="form-control" required>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2">Parent</div>
                <div class="col-md-10">
                    <?php 
                    //lay bien ket noi csdl
                    $conn = Connection::getInstance();
                    //thuc hien truy van
                    $query = $conn->query("select * from categories where parent_id = 0 order by id desc");
                    //lay tat ca cac ket qua tra ve
                    $categories = $query->fetchAll(PDO::FETCH_OBJ);
                     ?>
                    <select name="parent_id">
                       <option> Danh mục mới</option>
                    <?php foreach($categories as $val): ?> 
                        <option <?php if(isset($record->parent_id) && $record->parent_id == $val->id): ?> selected <?php endif ?> value="<?php echo $val->id; ?>"><?php echo $val->name; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!-- end rows -->
            <!-- rows -->
            <div class="row" style="margin-top:5px;">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <input type="submit" value="Process" class="btn btn-primary">
                </div>
            </div>
            <!-- end rows -->
        </form>
        </div>
    </div>
</div>