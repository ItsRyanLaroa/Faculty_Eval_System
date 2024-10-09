<?php include 'db_connect.php'; ?>
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];
    // Modify the query to also fetch the class_code, teacher's name, and subject code (which is the subject name)
    $class_qry = $conn->query("SELECT concat(c.curriculum, ' ', c.level, '-', c.section) as class, c.class_code, 
                                      t.firstname as teacher_firstname, t.lastname as teacher_lastname, 
                                      s.code as subject_name 
                               FROM class_list c
                               JOIN faculty_list t ON c.teacher_id = t.id 
                               JOIN subject_list s ON c.subject_id = s.id
                               WHERE c.id = $id");
    if($class_qry->num_rows > 0) {
        $class_data = $class_qry->fetch_assoc();
        $class_name = $class_data['class'];
        $class_code = $class_data['class_code'];
        $teacher_name = $class_data['teacher_firstname'] . ' ' . $class_data['teacher_lastname'];
        $subject_name = $class_data['subject_name']; // Fetch subject code as the subject name
    } else {
        $class_name = 'N/A';
        $class_code = 'N/A';
        $teacher_name = 'N/A';
        $subject_name = 'N/A';
    }
} else {
    echo "No class ID specified.";
    exit;
}
?>
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">
           
            <div class="class-details">
                <span class="class-name">Class: <?php echo $class_name; ?></span>
                <span class="class-code">Class Code: <?php echo $class_code; ?></span>
            </div>
            <div class="teacher-details">
                <span class="teacher-name">Teacher: <?php echo $teacher_name; ?></span>
                <span class="subject-name"> | Subject: <?php echo $subject_name; ?></span>
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
                    // Modify the query to only fetch students belonging to the class
                    $qry = $conn->query("SELECT s.*, concat(s.firstname, ' ', s.lastname) as name 
                                         FROM student_list s 
                                         INNER JOIN class_list e ON s.class_id = e.id 
                                         WHERE e.id = $id 
                                         ORDER BY concat(s.firstname,' ',s.lastname) ASC");
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

    .teacher-details {
        margin-top: 10px;  /* Add some space between class details and teacher name */
        font-size: 16px;
    }

    .teacher-name {
        font-weight: bold;
        color: #333;
    }

    .subject-name {
        font-size: 16px;
        color: #666;
    }
    .card-success.card-outline {
    border-top: none;
}
table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
    border-bottom-width: 0;
    border: none;
    color: #333; 
    font-weight: 500; /* Add slight boldness */
}

/* Table styling */
table.table-bordered.dataTable {
    border-right-width: 0;
    border: none;
}
	/* Red table header */
	.card-primary.card-outline {
    border-top: none;
}


/* Red table header */
thead th {
    background-color: #dc143c ; 
    color: white; /* White text for contrast */
    text-align: center;
    font-weight: bold;
	
}

/* Card header styling */
.card-header {
    background-color: transparent;
    border-bottom: none;
    padding: .75rem 1.25rem;
    position: relative;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}

/* Button styles */
.btn-primary {
    color: blue;
    background-color: white;
    border: none;
}


.btn-danger {
    color: red;
    background-color: white;
    border: none;
}

/* Hover effect for rows */
tbody tr:hover {
    background-color: #f1f1f1; /* Light gray hover */
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
