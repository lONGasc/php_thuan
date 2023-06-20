<?php 
	//load file layout vao day
	self::$fileLayout = "LayoutView.php";
 ?>
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="index.php?controller=categories&action=create" class="btn btn-primary">Add category</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">List categories</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Name</th>
               
                    <th style="width:100px;"></th>
                </tr>
             
                <?php foreach($data as $value): ?>
                <tr>
                    <td><?php echo $value->name; ?></td>
                
                    <td style="text-align:center;">
                        <a href="index.php?controller=categories&action=update&id=<?php echo $value->id; ?>">Edit</a>&nbsp;
                        <a href="index.php?controller=categories&action=delete&id=<?php echo $value->id; ?>" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                   <?php 

                    $data = Connection::getInstance();
        // thực hiện truy vấn
        $query = $data->prepare("select * from categories where parent_id =:_parent_id order by id desc");
         $query->execute(["_parent_id"=>$value->id]);
        // trả về 1 bản ghi
         $data1 = $query->fetchAll(PDO::FETCH_OBJ);
     

                 ?>
                 <?php foreach($data1 as $value): ?>
                  <tr>
                    <td style="padding-left: 20px"><?php echo $value->name  ; ?></td>
                
                    <td style="text-align:center;">
                        <a href="index.php?controller=categories&action=update&id=<?php echo $value->id; ?>">Edit</a>&nbsp;
                        <a href="index.php?controller=categories&action=delete&id=<?php echo $value->id; ?>" onclick="return window.confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            	<?php endforeach; ?>
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            <ul class="pagination">
            	<li class="page-itemn"><a href="#" class="page-link">Trang</a></li>
            	<?php for($i= 1; $i <= $numPage; $i++): ?>
            		<li class="page-itemn"><a href="index.php?controller=categories&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            	<?php endfor; ?>
            </ul>
        </div>
    </div>
</div>