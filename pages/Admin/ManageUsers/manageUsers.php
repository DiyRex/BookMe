<?php
@session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== "Admin") {
    header('Location: /');
    exit;
}
include_once './data/fetchUsers.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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

    <div class="container">
        <h1 class="text-center main-title mt-4 mb-4"><i class="fa-solid fa-person" style="color: #38B000;"></i> Manage <span style="color: #38b000">Users</span></h1>
        <div class="row">
            <div class="col-md-12">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search by name..." onkeyup="searchName()">
                </div>
                <div class="filter mb-3 dropdown">
                    <select class="form-select btn btn-secondary dropdown-toggle" style="background-color: #004B23;" id="roleFilter" onchange="filterRole()">
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <option class="text-left" value="">Filter by Role</option>
                            <option class="text-left" value="Student">Student</option>
                            <option class="text-left" value="Landlord">Landlord</option>
                            <option class="text-left" value="Warden">Warden</option>
                        </div>
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle" id="userTable">
                        <thead>
                            <tr>
                                <th scope="col">UserID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $users = fetchUsers();
                            foreach ($users as $user) {
                                $deletebtn;
                                if (isset($user['Role']) && $user['Role'] !== "Admin") {
                                    $deletebtn = "<a class='btn btn-danger btn-sm text-white'><i class='fa-solid fa-trash'></i></a>";
                                } else {
                                    $deletebtn = "Restricted";
                                }
                                echo "
                                <tr>
                                <td>" . htmlspecialchars($user['UserID']) . "</td>
                                <td>" . htmlspecialchars($user['Name']) . "</td>
                                <td>" . htmlspecialchars($user['Email']) . "</td>
                                <td>" . htmlspecialchars($user['ContactNo']) . "</td>
                                <td>" . htmlspecialchars($user['Role']) . "</td>
                                <td>" . $deletebtn . "</td>
                                </tr>
                                ";
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
        function filterRole() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("roleFilter");
            filter = input.value.toUpperCase();
            table = document.getElementById("userTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4]; // Column index for 'Role'
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (filter === "" || txtValue.toUpperCase() === filter) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

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