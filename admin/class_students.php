<?php include'db_connect.php' ?>
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];
    // Modify the query to also fetch the class_code
    $class_qry = $conn->query("SELECT concat(curriculum, ' ', level, '-', section) as class, class_code FROM class_list WHERE id = $id");
    if($class_qry->num_rows > 0) {
        $class_data = $class_qry->fetch_assoc();
        $class_name = $class_data['class'];
        $class_code = $class_data['class_code'];
    } else {
        $class_name = 'N/A';
        $class_code = 'N/A';
    }
} else {
    echo "No class ID specified.";
    exit;
}
?>
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <!-- Use divs for class name and class code, both in the same line -->
            <div class="class-details">
                <span class="class-name">Class: <?php echo $class_name; ?></span>
                <span class="class-code">Class Code: <?php echo $class_code; ?></span>
            </div>
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_student"><i class="fa fa-plus"></i> Add New Student</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table tabe-hover table-bordered" id="list">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>School ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM student_list WHERE id = $id ORDER BY concat(firstname,' ',lastname) ASC");
                    while($row= $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <th class="text-center"><?php echo $i++ ?></th>
                        <td><b><?php echo $row['school_id'] ?></b></td>
                        <td><b><?php echo ucwords($row['name']) ?></b></td>
                        <td><b><?php echo $row['email'] ?></b></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item view_student" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="./index.php?page=edit_student&id=<?php echo $row['id'] ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_student" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
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
    .class-details {
        display: flex;
        align-items: center;  /* Aligns the items vertically */
        font-size: 18px;      /* Set a standard font size */
    }

    .class-name {
        font-weight: bold;
        margin-right: 15px;  /* Add space between the class name and class code */
    }

    .class-code {
        color: #555;  /* Make the class code a lighter shade */
    }
</style>


<script>
    $(document).ready(function(){
        $('#list').dataTable()
        $('.view_student').click(function(){
            uni_modal("<i class='fa fa-id-card'></i> Student Details", "<?php echo $_SESSION['login_view_folder'] ?>view_student.php?id=" + $(this).attr('data-id'))
        })
        $('.delete_student').click(function(){
            _conf("Are you sure to delete this student?", "delete_student", [$(this).attr('data-id')])
        })
    })
    
    function delete_student($id){
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_student',
            method: 'POST',
            data: {id: $id},
            success: function(resp){
                if(resp == 1){
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function(){
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
</script>
