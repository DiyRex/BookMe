<?php
@session_start();

include_once __DIR__ . '/../helpers/dbConn.php';


function fetchStdBookingsByID($id){
    if (isset($_SESSION['loggedin']) && $_SESSION['role'] == "Student" ) {
        global $mysqli;
        $id = $mysqli->real_escape_string($id);
        $query = 'SELECT ' .
         'booking.BookingID, ' .
         'property.Title, ' .
         'owner.Name AS OwnerName, ' .  
         'booker.ContactNo, ' .  
         'booking.BookingDate ' .
         'FROM ' .
         'booking ' .
         'INNER JOIN ' .
         'property ON booking.PropertyID = property.PropertyID ' .
         'INNER JOIN ' .
         'user AS owner ON property.OwnerID = owner.UserID ' .
         'JOIN ' .
         'user AS booker ON booking.UserID = booker.UserID ' .
         'WHERE ' .
         'booking.UserID = ?;';
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            header('Location: /');
            exit;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // No records found, redirect to /explore
            $stmt->close();
            header('Location: /notFound');
            exit;
        }

        // Initialize an array to hold all bookings
        $bookings = [];
        while($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
        
        if (empty($bookings)) {
            // Failed to fetch or no bookings available, redirect to /explore
            $stmt->close();
            header('Location: /');
            exit;
        }

        $stmt->close();
        return $bookings;
    } else {
        // Access denied, redirect to /explore
        header('Location: /explore');
        exit;
    }
}
