<?php
require '../vendor/autoload.php'; // Adjust the path as necessary for PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

if (isset($_FILES['excel_file'])) {
    // Check if the file is uploaded
    if ($_FILES['excel_file']['error'] == UPLOAD_ERR_OK) {
        $fileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($_FILES['excel_file']['tmp_name']);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($fileType);
        $spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        
        // Connect to the database
        include '../db_connect.php'; // Include your database connection file

        // Loop through each row of the spreadsheet
        foreach ($sheetData as $row) {
            $school_id = $row['A']; // Adjust column index as per your Excel file
            $firstname = $row['B'];
            $lastname = $row['C'];
            $position = $row['D']; 
            $email = $row['E']; // Assuming column E holds the email
            $password = $row['F']; // Assuming column F holds the plain-text password

            // Hash the password before storing it in the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind (updated to insert into faculty_list)
            $stmt = $conn->prepare("INSERT INTO faculty_list (school_id, firstname, lastname, position, email, password) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $school_id, $firstname, $lastname, $position, $email, $hashedPassword);

            // Execute the statement
            if (!$stmt->execute()) {
                // Handle errors (e.g., log them or store in an error array)
                error_log("Error inserting data: " . $stmt->error);
            }
        }

        // Close the statement
        $stmt->close();
        // Redirect or return success message
        header('Location: ../index.php?page=faculty_list&success=1');
        exit;
    } else {
        // Handle file upload error
        header('Location: ../index.php?page=faculty_list&error=upload_error');
        exit;
    }
} else {
    // Handle missing file
    header('Location: ../index.php?page=faculty_list&error=file_missing');
    exit;
}