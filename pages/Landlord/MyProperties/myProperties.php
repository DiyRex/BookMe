<?php include_once './data/fetchProperties.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="./pages/Landlord/MyProperties/myProperties.css">
    <link rel="stylesheet" href="../../../components/navbar.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <title>My Properties</title>
</head>

<body>
    <?php include_once './components/navbar.php' ?>
    <div class="container d-flex flex-column align-items-center justify-content-center mt-4 mt-md-5">
        <h1 class="text-center main-title"><i class="fa-solid fa-location-dot" style="color: #38B000;"></i> My <span style="color: #38b000">Properties</span></h1>
        <div class="col-12">
            <a class="btn-add mb-2 mx-3" href="/addProperty">Add Property</a>
        </div>
        
        <!-- lines -->
        <?php
        
        $properties = fetchprops();
        if(isset($properties)){
            foreach ($properties as $property) {
                $deletebtn = "<a class='btn btn-danger btn-sm text-white'><i class='fa-solid fa-trash'></i></a>";
                $id = $property['PropertyID'];
                $title = $property['Title'];
                $description = $property['Description'];
                $bedCount = $property['BedCount'];
                $stdCount = $property['StdCount'];
                $rent = $property['Rent'];
                $keymoney = $property['Keymoney'];
                $address = $property['Address'];
                $property['Status'] == "Pending" ? $status = "<span class='text-danger'>Pending</span>" : $status = "<span class='text-success'>Approved</span>";
                echo 
<<<EOT
                <div class="property-section col-12 d-flex mt-2">
                <div class="card col-12 mt-3 d-flex">
                    <div class="card-single d-flex justify-content-between mb-2 border-secondary border-2">
                        <div class="title-section w-25">
                        <h5 class="title">$title</h5>
                            <h6 class="address w-75">$address</h6>
                        </div>
                        <div class="d-md-flex drop-container">
                            <div class="description mx-2 w-75">
                                <p>$description</p>
                            </div>
                            <div class="count d-flex flex-column flex-md-row">
                                <div class="bed d-flex mx-2 align-items-center justify-content-center">
                                    <i class="fa-solid fa-bed mx-2"></i>
                                    <p class="pt-3 mx-md-2">$bedCount</p>
                                </div>
                                <div class="student d-flex mx-2 justify-content-center align-items-center">
                                    <i class="fa-solid fa-person mx-2"></i>
                                    <p class="pt-3 mx-md-2">$stdCount</p>
                                </div>
                            </div>
                        </div>
                        <div class="rent">
                            <div class="rent-d">
                                <p>Rent</p>
                                <p> LKR $rent</p>
                            </div>
                            <div class="rent-d">
                                <p>Keymoney</p>
                                <p>LKR $keymoney</p>
                            </div>
                            <div class="status-d">
                                <p>Status</p>
                                <p>$status</p>
                            </div>
                        </div>
                        <div class="btn-section flex-column flex-md-row align-items-md-center justify-content-md-center mx-2 d-none d-md-flex">
                            <a href="/edit?id=$id" class='btn btn-success btn-md text-white mx-2' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Edit Property'><i class='fa-solid fa-pen'></i></a>
                            <a href="/deleteProperty?id=$id" class='btn btn-danger btn-md text-white mx-2 mx-md-0 mt-2 mt-md-0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Delete Property'><i class='fa-solid fa-trash'></i></a>
                        </div>
                        <div class="btn-section flex-column flex-md-row align-items-md-center justify-content-md-center mx-2 d-block d-md-none">
                            <a href="/edit?id=$id" class='btn btn-success btn-sm text-white mx-2' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Edit Property'><i class='fa-solid fa-pen'></i></a>
                            <a href="/deleteProperty?id=$id" class='btn btn-danger btn-sm text-white mx-2 mx-md-0 mt-2 mt-md-0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Delete Property'><i class='fa-solid fa-trash'></i></a>
                        </div>
                    </div>
                </div>
        </div>
EOT;
            }
        }
        ?>
        
        <!-- end lines -->
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>