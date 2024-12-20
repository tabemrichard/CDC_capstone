<?php
namespace Controller;

include_once '../../Config/DbConnection.php';

class login extends \DbConnection
{
    public function parentLogin($userName, $password)
    {
        // Prepare the query to select the user based on the username or email
        $query = 'SELECT * FROM parent WHERE Email_Or_username = ?';
        $stmt = $this->Connect()->prepare($query);

        // Bind the username to the query
        $stmt->bind_param('s', $userName);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();
        $parent = $result->fetch_assoc();

        // Check if a user was found and verify the password
        if ($parent && password_verify($password, $parent['Password'])) {
            session_start();
            $_SESSION['StudentId'] = $parent['StudentNumber'];
            $_SESSION['Name'] = $parent['FullName'];
            echo json_encode(['success' => true, 'message' => 'You are Successfully Logged']);
        } else {
          echo json_encode(['success' => false, 'message' => 'Invalid Password or Username']);
        }
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    if (empty($userName) && empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Please enter your username and password to continue.']);
    }else{
        $Login = new login();
        $Login->parentLogin($userName,$password);
    }
}
