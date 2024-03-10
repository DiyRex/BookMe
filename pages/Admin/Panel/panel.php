<?php
@session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== "Admin") {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Dashboard</title>
    <link rel="stylesheet" href="./components/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .btn-custom {
            color: #fff;
            padding: 10px 20px;
            margin: 5px;
        }

        .btn-manage-users {
            background-color: #007bff;
            width: 180px;
        }

        .btn-manage-properties {
            background-color: #28a745;
            width: 180px;
        }
        .btn-article{
            background-color: #a83238;
            width: 180px;
        }

    </style>
</head>

<body>
<?php include_once './components/navbar.php';?>
    <div class="container text-center mt-5">
        <h2 class="mb-2">Hello, Admin !</h2>
        <h4 class="mt-3">Welcome to the Management Dashboard</h2>
        <p>Select an option below to proceed:</p>
        <div class="mt-4">
            <form action="/explore" method="get" class="d-inline">
                <input type="hidden" name="action" value="propertyManage">
                <button type="submit" class="btn btn-custom btn-manage-properties">Manage Properties</button>
            </form>
            <form action="/explore" method="get" class="d-inline">
                <input type="hidden" name="action" value="manageUsers">
                <button type="submit" class="btn btn-custom btn-manage-users">Manage Users</button>
            </form>
            <form action="/explore" method="get" class="d-inline">
                <input type="hidden" name="action" value="article">
                <button type="submit" class="btn btn-custom btn-article">Articles</button>
            </form>

            <!-- <form action="/explore" method="get" class="d-inline">
                <input type="hidden" name="action" value="pendingProperties">
                <button type="submit" class="btn btn-custom btn-pending-properties">Pending Properties</button>
            </form> -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>