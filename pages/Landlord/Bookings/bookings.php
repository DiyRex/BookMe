<?php
@session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== "Landlord") {
    header('Location: /');
    exit;
}
include_once './data/fetchBooking.php';
$stdID = $_SESSION['user_id'];
$bookings = fetchLndBookingsByID($stdID);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link rel="stylesheet" href="../../components/navbar.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .container {
            padding-top: 20px;
        }

        .table-responsive {
            margin: auto;
        }

        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box .fa-search {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .search-box input {
            padding-left: 30px;
        }

        .delete-btn {
            color: #ff0000;
        }
    </style>
</head>

<body>
<?php include_once './components/navbar.php'; ?>
    <div class="container">
        <h1 class="text-center main-title mt-4 mb-4"><i class="fa-solid fa-book" style="color: #38B000;"></i> My <span style="color: #38b000">Bookings</span></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search by name..." onkeyup="searchName()">
                </div>
                <div class="table-responsive">
                    <table class="table align-middle" id="userTable">
                        <thead>
                            <tr>
                                <th scope="col">Booking ID</th>
                                <th scope="col">Property</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Booking Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($bookings)){
                                foreach ($bookings as $booking) {
                                $bookingID = $booking['BookingID'];
                                $deletebtn = "<a href='/deleteBooking?id=$bookingID' class='btn btn-danger btn-sm text-white'><i class='fa-solid fa-trash'></i></a>";
                                echo "
                                <tr>
                                <td>" . htmlspecialchars($booking['BookingID']) . "</td>
                                <td>" . htmlspecialchars($booking['Title']) . "</td>
                                <td>" . htmlspecialchars($booking['StudentName']) . "</td>
                                <td>" . htmlspecialchars($booking['ContactNo']) . "</td>
                                <td>" . htmlspecialchars($booking['BookingDate']) . "</td>
                                <td>" . $deletebtn . "</td>
                                </tr>
                                ";
                            }}else{
                                echo '<div class="alert alert-danger" role="alert">
                                No data found.
                            </div>';
                            }
                            
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script>

        function searchName() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("userTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Column index for 'Name'
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>