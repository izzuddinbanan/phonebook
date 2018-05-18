            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
						<div class="panel-body">
							
							<!-- <div class="row">
								<form class="navbar-form pull-right" method="POST" action="">
									<div class="form-group">
										<input type="text" name="cari"  class="form-control" value="<?php echo isset($search_data['cari']) ? $search_data['cari'] : ''; ?>" placeholder="Search by Name">
									</div>
									<button type="submit" class="btn btn-default">Submit</button>
								</form>
								
							</div> -->
							
							
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name </th>
                                            <th>Phone Number</th>
                                            <th>address</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
									<tbody>
									<?php
									if($query_list->num_rows() > 0) {
									foreach($query_list->result() as $list) {?>
                                   
										<tr>
											<td><?php echo $list->name ?></td>
											<td><?php echo $list->phone ?></td>
											<td><?php echo $list->address ?></td>
											<td><a href=""  class="btn btn-primary">update</a>
												<a href="" class="btn btn-danger">delete</a> 
											</td>
										</tr>
									
									<?php 
										}
									} 
									else {	
									?>
										<tr>
											<td colspan="20"> No Record Found</td>
										</tr>
									<?php
									} ?>
									</tbody>
                                </table>
								
							</div>
								
					    </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>





