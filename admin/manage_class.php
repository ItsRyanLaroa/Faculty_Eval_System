<?php
include '../db_connect.php';

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM class_list WHERE id={$_GET['id']}")->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}

// Generate a random class code if not already set
$code = isset($code) ? $code : substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
?>
<div class="container-fluid">
    <form action="" id="manage-class">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div id="msg" class="form-group"></div>

        <!-- Curriculum input -->
        <div class="form-group">
            <label for="curriculum" class="control-label">Department</label>
            <input type="text" class="form-control form-control-sm" name="curriculum" id="curriculum" value="<?php echo isset($curriculum) ? $curriculum : '' ?>" required>
        </div>

        <!-- Year Level input -->
        <div class="form-group">
            <label for="level" class="control-label">Year Level</label>
            <input type="text" class="form-control form-control-sm" name="level" id="level" value="<?php echo isset($level) ? $level : '' ?>" required>
        </div>

        <!-- Section input -->
        <div class="form-group">
            <label for="section" class="control-label">Section</label>
            <input type="text" class="form-control form-control-sm" name="section" id="section" value="<?php echo isset($section) ? $section : '' ?>" required>
        </div>

        <!-- Teacher dropdown -->
        <div class="form-group">
            <label for="teacher_id" class="control-label">Teacher</label>
            <select name="teacher_id" id="teacher_id" class="custom-select custom-select-sm" required>
                <?php
                $teacher = $conn->query("SELECT * FROM faculty_list ORDER BY lastname ASC");
                while($row = $teacher->fetch_assoc()):
                ?>
                    <option value="<?php echo $row['id'] ?>" <?php echo isset($teacher_id) && $teacher_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['lastname'].", ".$row['firstname'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Subject dropdown -->
        <div class="form-group">
            <label for="subject_id" class="control-label">Subject</label>
            <select name="subject_id" id="subject_id" class="custom-select custom-select-sm" required>
                <?php
                $subject = $conn->query("SELECT * FROM subject_list ORDER BY subject ASC");
                while($row = $subject->fetch_assoc()):
                ?>
                    <option value="<?php echo $row['id'] ?>" <?php echo isset($subject_id) && $subject_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['subject'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </form>
</div>


<script>
	$(document).ready(function(){
		$('#manage-class').submit(function(e){
			e.preventDefault();
			start_load();
			$('#msg').html('');

			$.ajax({
				url: 'ajax.php?action=save_class',
				method: 'POST',
				data: $(this).serialize(),
				success: function(resp){
					if(resp == 1){
						alert_toast("Data successfully saved.", "success");
						setTimeout(function(){
							location.reload();
						}, 1750);
					} else if(resp == 2){
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Class already exists.</div>');
						end_load();
					}
				}
			});
		});
	});
</script>
