<?php
@session_start();


include_once __DIR__ . '/../helpers/dbConn.php';
function fetchprops()
{
    if (isset($_SESSION['loggedin']) && ($_SESSION['role'] == "Warden" ||$_SESSION['role'] == "Landlord") ) {
        global $mysqli;
        $query = "SELECT property.PropertyID, property.Title, property.Description, property.Address, property.StdCount, property.BedCount, property.Rent, property.Keymoney, property.Status, user.Name 
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
