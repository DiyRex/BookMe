<?php
@session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== "Warden") {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Properties</title>
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

        .approve-btn {
            color: #4CAF50;
        }

        .reject-btn {
            color: #F44336;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center main-title mt-4 mb-4"><i class="fa-solid fa-house" style="color: #FBFA00;"></i> Pending <span style="color: #FFA000">Properties</span></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search by title..." onkeyup="searchName()">
                </div>
                <div class="table-responsive">
                    <table class="table align-middle" id="pendingPropertyTable">
                        <thead>
                            <tr>
                                <th scope="col">Property ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Bed Count</th>
                                <th scope="col">Keymoney</th>
                                <th scope="col">Rent</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
            table = document.getElementById("pendingPropertyTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Column index for 'Title'
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