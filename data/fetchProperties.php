<?php
@session_start();


include_once __DIR__ . '/../helpers/dbConn.php';
function fetchprops()
{
    if (isset($_SESSION['loggedin'])) {
        global $mysqli;
        $query = "SELECT property.PropertyID, property.Title, property.Description, property.Address, property.StdCount, property.BedCount, property.Rent, property.Keymoney, property.Status, user.Name 
        FROM property 
        INNER JOIN user ON property.OwnerID = user.UserID";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            echo "Error preparing statement: " . $mysqli->error;
            return false;
        }
        $stmt->execute();
        $result = $stmt->get_result();

        while ($prop = $result->fetch_assoc()) {
            $props[] = $prop;
        }

        $stmt->close();
        return $props;
    } else {
        return null;
    }
}

function fetchPropsByID($id){
    if (isset($_SESSION['loggedin'])) {
        global $mysqli;
        $id = $mysqli->real_escape_string($id);
        $query = "SELECT * FROM property WHERE PropertyID=?";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            header('Location: /explore');
            exit;
        }

        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // No records found, redirect to /explore
            $stmt->close();
            header('Location: /explore');
            exit;
        }

        $prop = $result->fetch_assoc();
        
        if (!$prop) {
            // Failed to fetch, redirect to /explore
            $stmt->close();
            header('Location: /explore');
            exit;
        }

        $stmt->close();
        return $prop;
    } else {
        // Access denied, redirect to /explore
        header('Location: /explore');
        exit;
    }
}

function fetchPropImagesByID($id){
    if (isset($_SESSION['loggedin'])) {
        global $mysqli;
        $id = $mysqli->real_escape_string($id);
        $query = "SELECT * FROM images WHERE PropertyID=?";
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            echo "Error preparing statement: " . $mysqli->error;
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($image = $result->fetch_assoc()) {
            $images[] = $image;
        }

        $stmt->close();
        if(isset($images)){
            return $images;
        }
    } else {
        return null;
    }
}

function fetchImagePathByID($imageID) {
    global $mysqli;
    $query = "SELECT ImagePath FROM images WHERE ImageID = ?";
    $stmt = $mysqli->prepare($query);
    if (!$stmt) {
        echo "Error preparing statement: " . $mysqli->error;
        return false;
    }
    $stmt->bind_param("i", $imageID);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $result = $stmt->fetch();
    $stmt->close();

    if ($result) {
        return $imagePath;
    } else {
        return false; // No image found for the given ID
    }
}

