<?php

namespace Controller;

include_once '../../Config/DbConnection.php';  // Ensure this path is correct

class Register extends \DbConnection
{
    public function RegisterParent($userName, $password, $childName, $studentID, $parentName)
    {
        // Query to check if the username already exists in the parent table
        $usernameQuery = 'SELECT Email_Or_username FROM parent WHERE Email_Or_username = ?';
        $stmt = $this->Connect()->prepare($usernameQuery);
        $stmt->bind_param('s', $userName);
        $stmt->execute();
        $usernameResult = $stmt->get_result();

        // If username already exists, return an error
        if ($usernameResult->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Username already exists']);
            return;
        }

        // Query to check if the student ID exists in the student table
        $studentIDQuery = 'SELECT StudentNo FROM student WHERE StudentNo = ?';
        $stmt = $this->Connect()->prepare($studentIDQuery);
        $stmt->bind_param('s', $studentID);
        $stmt->execute();
        $studentId = $stmt->get_result();

        // Check if a valid student ID is returned
        if ($studentId->num_rows > 0) {
            $passHashed = password_hash($password, PASSWORD_BCRYPT);

            // Insert new parent details
            $query = "INSERT INTO parent(Email_Or_username, Password, StudentName, StudentNumber, FullName) 
                      VALUES(?,?,?,?,?)";
            $stmt = $this->Connect()->prepare($query);
            $stmt->bind_param('sssss', $userName, $passHashed, $childName, $studentID, $parentName);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Successfully Registered']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed', 'error' => $stmt->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid Student Number']);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [];
    $error = [];

    $userName = $_POST['UserName'];
    $password = $_POST['Password'];
    $childName = $_POST['childName'];
    $studentNumber = $_POST['StudentNumber'];
    $parentName = $_POST['parentName'];

    // Input validation
    if (empty($userName)) {
        $error['userName'] = 'Username is required';
    }
    if (!filter_var($userName, FILTER_VALIDATE_EMAIL)) {
        $error['invalidEmail'] = 'Invalid email format';
    }
    if (!filter_var($password, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{7,}$/")))){
        $error['password'] = 'Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character (!,@,$,%,&,*,?)';
    }
    if (empty($password)) {
        $error['password'] = 'Password is required';
    }
    if (empty($childName)) {
        $error['childName'] = 'Child name is required';
    }
    if (empty($studentNumber)) {
        $error['studentNumber'] = 'Student number is required';
    }
    if (empty($parentName)) {
        $error['parentName'] = 'Parent name is required';
    }

    // If there are validation errors, return them as a JSON response
    if (!empty($error)) {
        $data['success'] = false;
        $data['errors'] = $error;
        echo json_encode($data);
    } else {
        // Register the parent if no errors
        $Register = new Register();
        $Register->RegisterParent($userName, $password, $childName, $studentNumber, $parentName);
    }
}
