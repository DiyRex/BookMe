<?php
@session_start();


include_once __DIR__ . '/../helpers/dbConn.php';
function fetchUsers()
{
    if (isset($_SESSION['loggedin']) && $_SESSION['role'] == "Admin") {
        global $mysqli;
        $query = "SELECT user.UserID, user.Name, user.Email, user.ContactNo, role.Role FROM user INNER JOIN role ON user.RoleID = role.RoleID";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];

        while ($user = $result->fetch_assoc()) {
            $users[] = $user;
        }

        $stmt->close();
        return $users;
    } else {
        return null;
    }
}
