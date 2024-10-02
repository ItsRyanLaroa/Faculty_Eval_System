<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_class" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="60%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Class</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT *,concat(curriculum,' ',level,'-',section) as `class` FROM class_list order by class asc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo $row['class'] ?></b></td>
						<td class="text-center">
							<div class="btn-group">
								<a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_class">
									<i class="fas fa-edit"></i>
								</a>
								<button type="button" class="btn btn-danger btn-flat delete_class" data-id="<?php echo $row['id'] ?>">
									<i class="fas fa-trash"></i>
								</button>
								<a class="dropdown-item class_student manage-students-btn" href="index.php?page=class_students&id=<?php echo $row['id'] ?>">Manage </a>
							</div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	.manage-students-btn {
    display: inline-block; /* To ensure it behaves like a button */
    padding: 8px 12px; /* Padding for better clickable area */
    background-color: #007bff; /* Bootstrap primary color */
    color: white; /* Text color */
    border: none; /* Remove default border */
    border-radius: 4px; /* Rounded corners */
    text-decoration: none; /* Remove underline from link */
    font-size: 14px; /* Font size */
    transition: background-color 0.3s, transform 0.2s;
}

.manage-students-btn:hover {
    background-color: #0056b3; /* Darker shade on hover */
    transform: translateY(-2px); /* Lift effect on hover */
}

.manage-students-btn:active {
    background-color: #004494; /* Even darker shade on click */
    transform: translateY(0); /* Reset lift effect */
}
.btn-group, .btn-group-vertical {
    position: relative;
    display: -ms-inline-flexbox;
    display: inline-flex;
    vertical-align: middle;
    gap: 20px;
}

</style>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
		$('.new_class').click(function(){
			uni_modal("New class","<?php echo $_SESSION['login_view_folder'] ?>manage_class.php")
		})
		$('.manage_class').click(function(){
			uni_modal("Manage class","<?php echo $_SESSION['login_view_folder'] ?>manage_class.php?id="+$(this).attr('data-id'))
		})
		$('.delete_class').click(function(){
			_conf("Are you sure to delete this class?","delete_class",[$(this).attr('data-id')])
		})
	})
	
	function delete_class($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_class',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
</script>
