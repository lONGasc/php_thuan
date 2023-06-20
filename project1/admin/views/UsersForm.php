<?php 
	//load file layout vao day
	self::$fileLayout = "LayoutView.php";
 ?>
                     <div class="col-md-12">  
                        <div class="panel panel-primary">
                            <div class="panel-heading">Add edit user</div>
                            <div class="panel-body">
                            <form method="post" action="<?php echo "$action"; ?>">
                                <!-- rows -->
                                <div class="row" style="margin-top:5px;">
                                    <div class="col-md-2">Name</div>
                                    <div class="col-md-10">
                                        <input type="text" value="<?php echo isset($record->name) ? $record->name : ""; ?>" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <!-- end rows -->
                                <!-- rows -->
                                <div class="row" style="margin-top:5px;">
                                    <div class="col-md-2">Email</div>
                                    <div class="col-md-10">
                                        <input type="email" value="<?php echo isset($record->email) ? $record->email : ""; ?>" name="email" class="form-control" required>
                                    </div>
                                </div>
                                <!-- end rows -->
                                <!-- rows -->
                                <div class="row" style="margin-top:5px;">
                                    <div class="col-md-2">Password</div>
                                    <div class="col-md-10">
                                        <input type="password" name="password" class="form-control" placeholder="Không đổi password thì không nhập thông tin vào ô textbox này">
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