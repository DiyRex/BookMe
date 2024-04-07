<?php
@session_start();

include_once __DIR__ . '/../helpers/dbConn.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['mode']) && $_POST['mode'] === 'login') {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $email = mysqli_real_escape_string($mysqli, $_POST['email']);
            $password = mysqli_real_escape_string($mysqli, $_POST['password']);

            //validate
            $query = "SELECT user.UserID, user.Email, user.Password, role.Role FROM user INNER JOIN role ON user.RoleID = role.RoleID WHERE user.Email = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if ($user && $user['Password'] == $password) {
                $_SESSION['email'] = $user['Email'];
                $_SESSION['role'] = $user['Role'];
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['UserID'];
                header('Location: /');
            } else {
                echo "invalid login";
            }
            $stmt->close();
        } else {
            echo "both username and password are required";
        }
    } else if (isset($_POST['mode']) && $_POST['mode'] === 'signup') {
        $name = $_POST["name"];
        $nic = $_POST['nic'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $role = (int) $_POST['role'];
        $signup_email = $_POST['signup_email'];
        $signup_password = $_POST['signup_password'];
        if (isset($_POST['role']) && $_POST['role'] === "1") {
            $degreeDuration = (int) $_POST['degreeDuration'];
            $uniID = $_POST['uniID'];
        }
        if (isset($_POST['role']) && $_POST['role'] === "1") {
            $user_ins_query = "INSERT INTO user (Name, NIC, Address, ContactNo, Email, Password, RoleID) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $student_ins_query = "INSERT INTO `student` (`UserID`, `DegDuration`, `UniID`) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($user_ins_query);
            $stmt->bind_param("ssssssi", $name, $nic, $address, $contact, $signup_email, $signup_password, $role);
            if ($stmt->execute()) {
                $lastInsertedId = $mysqli->insert_id;
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
            $stmt = $mysqli->prepare($student_ins_query);
            $stmt->bind_param("iis", $lastInsertedId, $degreeDuration, $uniID);
            $stmt->execute();
            $stmt->close();
            header('Location: /auth');
        }
    } else if (isset($_POST['role']) && ($_POST['role'] !== "1")) {
        $ins_query = "INSERT INTO user (Name, NIC, Address, ContactNo, Email, Password, RoleID) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($ins_query);
        $stmt->bind_param("ssssssi", $name, $nic, $address, $contact, $signup_email, $signup_password, $role);
        $stmt->execute();
        $stmt->close();
        header('Location: /auth');
        exit;
    }
} else if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        header('Location: /');
    } else {
        include './pages/AuthPage/auth.php';
    }
}
