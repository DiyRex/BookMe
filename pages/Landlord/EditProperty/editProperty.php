<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">
    <link rel="stylesheet" href="./pages/Landlord/Editproperty/editProperty.css">
    <link rel="stylesheet" href="./components/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <title>Edit Property</title>
</head>
<body>
    <?php
    require_once './data/fetchProperties.php';
    if(isset($_GET['id'])){
        $property = fetchPropsByID($_GET['id']);
        $title = $property['Title'];
        $description = $property['Description'];
        $bedCount = $property['BedCount'];
        $stdCount = $property['StdCount'];
        $rent = $property['Rent'];
        $keymoney = $property['Keymoney'];
        $address = $property['Address'];
        $coordinates = $property['Coordinates'];
    }
    ?>
<?php include_once './components/navbar.php';?>
<div class="container d-flex flex-column align-items-center justify-content-center">
    <h1 class="text-center title"><i class="fa-solid fa-house" style="color: #38B000;"></i> Edit <span style="color: #38b000">Property</span></h1>
    <div class="box col-10 col-md-6 text-white">
        <form action="/edit" method="POST"  enctype="multipart/form-data">
            <input type="hidden" name="property_id" value="<?=$_GET['id']?>">
            <div class="form-group">
                <label for="titleInput">Title</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-signature" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="titleInput" name="title" placeholder="Title" value="<?=$title?>">
                </div>
            </div>
            <div class="form-group">
                <label for="descriptionInput">Description</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-file-lines" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="descriptionInput" name="description" placeholder="Description" value="<?=$description?>">
                </div>
            </div>
            <div class="form-group">
                <label for="addressInput">Address</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-location-dot" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="addressInput" name="address" placeholder="Address" value="<?=$address?>">
                </div>
            </div>
            <!-- Location Section -->
            <div class="form-group">
                <label for="locationInput">Location</label>
                <div id="map" class="map-section"></div>
                <input type="hidden" id="advCoordinates" name="coordinates" value="<?=$coordinates?>">
            </div>
            <div class="form-group">
                <label for="bedCountInput">Bed Count</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-bed" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="bedCountInput" name="bedCount" placeholder="Bed Count" value="<?=$bedCount?>">
                </div>
            </div>
            <div class="form-group">
                <label for="studentCountInput">Student Count</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa-solid fa-person" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="studentCountInput" name="stdCount" placeholder="Student Count" value="<?=$stdCount?>">
                </div>
            </div>
            <div class="form-group">
                <label for="keymoneyInput">Keymoney</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-rupee-sign" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="keymoneyInput" name="keymoney" placeholder="Keymoney" value="<?=$keymoney?>">
                </div>
            </div>
            <div class="form-group">
                <label for="rentInput">Rent</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-rupee-sign" style="color: #38B000;"></i></div>
                    </div>
                    <input type="text" class="form-control" id="rentInput" name="rent" placeholder="Rent" value="<?=$rent?>">
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
            <!-- show images -->
            <div class="w-100 d-flex flex-wrap">
            <?php
            if(isset($_GET['id'])){
                $images = fetchPropImagesByID($_GET['id']);
                foreach($images as $image){
                    echo '
                    <div class="image-container mt-1 mx-1">
                    <img src="'.$image['ImagePath'].'" alt="Property Image" class="property-image"/>
                    <button type="button" class="close-image-btn" onclick="removeImage(this)">X</button>
                    <input type="hidden" name="deleteImages['.$image['ImageID'].']" value="0" />
                    </div>
                    ';
                }
                }
            ?>
            </div>
            <!-- Add more images as needed -->
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn-publish">Save</button>
            </div>
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

    // Parse the initial coordinates from the advCoordinates input value
    var initialCoords = document.getElementById('advCoordinates').value.split(',');
    var initialLat = parseFloat(initialCoords[0]);
    var initialLng = parseFloat(initialCoords[1]);

    // Function to add or move the marker
    function addOrMoveMarker(lat, lng) {
        var newLatLng = new L.LatLng(lat, lng);
        if (marker) {
            marker.setLatLng(newLatLng);
        } else {
            marker = L.marker(newLatLng).addTo(map);
        }
        document.getElementById('advCoordinates').value = lat + ',' + lng;
        map.setView(newLatLng, map.getZoom());
    }

    // Set initial marker position if coordinates are provided
    if (!isNaN(initialLat) && !isNaN(initialLng)) {
        addOrMoveMarker(initialLat, initialLng);
    }

    function onMapClick(e) {
        var coords = e.latlng;
        addOrMoveMarker(coords.lat, coords.lng);
    }

    map.on('click', onMapClick);

    //image handle
    function removeImage(button) {
        // Remove the parent .image-container of the clicked button
        const imageContainer = button.closest('.image-container');
        // Find the hidden input within this image container and set its value to 1
        imageContainer.querySelector('input[type="hidden"]').value = '1';
        // Optionally, visually indicate that the image is marked for deletion
        imageContainer.style.opacity = '0.5';
    }
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
