<?php
session_start();
session_unset();
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $response = [];

    if (empty($email) || empty($password)) {
        $response = ['status' => 'error', 'message' => 'Email or password cannot be empty'];
    } else {
        // Check if the user is an admin
        $query = "SELECT id, email, password FROM admins WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        if ($admin && password_verify($password, $admin['password'])) {
            // User found in admins table
            $_SESSION['admin_id'] = $admin['id'];
			$_SESSION['email'] = $admin['email'];
            $_SESSION['user_type'] = 'admin'; // Set the role as 'admin'
            
            $response = [
                'status' => 'success',
                'redirect' => 'Admin_Dashboard.php'
            ];
        } else {
            // Check if the user is a regular user
            $query = "SELECT id, email, password FROM users WHERE email = ? OR username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $email, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {
                // User found in users table
                $_SESSION['user_id'] = $user['id'];
				$_SESSION['email'] = $user['email'];
                $_SESSION['user_type'] = 'user'; // Set the role as 'user'
                
                $response = [
                    'status' => 'success',
                    'redirect' => 'User/user_dashboard.php'
                ];
            } else {
                $response = ['status' => 'error', 'message' => 'Invalid email or password'];
            }
        }
    }

    echo json_encode($response);
    exit;
}
?>