<?php
@session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== "Landlord") {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="./pages/Landlord/AddProperty/addProperty.css">
    <link rel="stylesheet" href="./components/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <title>Add Property</title>
</head>

<body>
    <?php include_once './components/navbar.php';?>
    <div class="container d-flex flex-column align-items-center justify-content-center">
        <h1 class="text-center title"><i class="fa-solid fa-house" style="color: #38B000;"></i> Add <span style="color: #38b000">Property</span></h1>
        <div class="box col-10 col-md-6 text-white">
            <form action="/addProperty" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titleInput">Title</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa-solid fa-signature" style="color: #38B000;"></i></div>
                        </div>
                        <input type="text" class="form-control" id="titleInput" placeholder="Title" name="title" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="descriptionInput">Description</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa-solid fa-file-lines" style="color: #38B000;"></i></div>
                        </div>
                        <input type="text" class="form-control" id="descriptionInput" placeholder="Description" name="description" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="addressInput">Address</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa-solid fa-location-dot" style="color: #38B000;"></i></div>
                        </div>
                        <input type="text" class="form-control" id="addressInput" placeholder="Address" name="address" required>
                    </div>
                </div>
                <!-- Location Section -->
                <div class="form-group">
                    <label for="locationInput">Location</label>
                    <div id="map" class="map-section"></div>
                    <input type="hidden" id="advCoordinates" value="" name="coordinates" required>
                </div>
                <div class="form-group">
                    <label for="bedCountInput">Bed Count</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa-solid fa-bed" style="color: #38B000;"></i></div>
                        </div>
                        <input type="text" class="form-control" id="bedCountInput" placeholder="Bed Count" name="bedCount" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="studentCountInput">Student Count</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa-solid fa-person" style="color: #38B000;"></i></div>
                        </div>
                        <input type="text" class="form-control" id="studentCountInput" placeholder="Student Count" name="studentCount" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keymoneyInput">Keymoney</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-rupee-sign" style="color: #38B000;"></i></div>
                        </div>
                        <input type="text" class="form-control" id="keymoneyInput" placeholder="Keymoney" name="keymoney" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rentInput">Rent</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-rupee-sign" style="color: #38B000;"></i></div>
                        </div>
                        <input type="text" class="form-control" id="rentInput" placeholder="Rent" name="rent" required>
                    </div>
                </div>
                <!-- Image Upload Section -->
                <div class="form-group">
                    <label for="imageUpload">Images</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa-solid fa-images" style="color: #38B000;"></i></div>
                        </div>
                        <input type="file" class="form-control image-choose" id="imageUpload" multiple name="images[]">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn-publish">Publish</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var map = L.map('map').setView([6.82068, 80.04127], 17);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(map);

        var marker;

        function onMapClick(e) {
            var coords = e.latlng;
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(coords).addTo(map);
            document.getElementById('advCoordinates').value = coords.lat + ',' + coords.lng;
        }

        map.on('click', onMapClick);
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>