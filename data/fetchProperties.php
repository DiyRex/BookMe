<?php
@session_start();


include_once __DIR__ . '/../helpers/dbConn.php';
function fetchprops()
{
    if (isset($_SESSION['loggedin']) && $_SESSION['role'] == "Warden") {
        global $mysqli;
        $query = "SELECT property.PropertyID, property.Title, property.Address, property.StudentCount, property.BedCount, property.Rent, property.Keymoney, user.Name 
        FROM property 
        INNER JOIN user ON property.OwnerID = user.UserID";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];

        while ($prop = $result->fetch_assoc()) {
            $props[] = $prop;
        }

        $stmt->close();
        return $props;
    } else {
        return null;
    }
}
