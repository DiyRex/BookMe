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
    <link rel="stylesheet" href="./components/navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <title>Explore Boarding</title>
    <style>
        .description {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .btn-half-width {
            width: 48%;
            /* Slightly less than half to accommodate margins/padding */
        }

        @media (max-width: 768px) {
            .btn-action {
                flex-basis: 100%;
                /* Make buttons full width on small screens */
                margin-bottom: 5px;
            }

            #map {
                height: 400px !important;
            }
        }
    </style>
</head>

<body>
    <?php include_once './components/navbar.php'; ?>
    <div class="container mt-4">
        <h2 class="text-center mt-md-4 mb-5"><i class="fa-solid fa-location-dot"></i> Manage <span style="color: #38b000">Properties</span></h2>
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div id="map" style="height: 800px;"></div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div id="carouselExampleIndicators" class="carousel slide card-img-top" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" id="carouselInner">
                            <div class="carousel-item active">
                                <img src="https://via.placeholder.com/400x200" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://via.placeholder.com/400x200" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://via.placeholder.com/400x200" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" id="card-title">Property Title</h5>
                        <p class="card-text description" id="card-desc">Description</p>
                        <p class="card-text" ><strong>Address: </strong><span id="card-address"></span></p>
                        <p class="card-text" ><strong>Keymoney: </strong><span id="card-keymoney"></span></p>
                        <p class="card-text" ><strong>Rent: </strong><span id="card-rent"></span></p>
                        <p class="card-text" ><strong>Bed Count: </strong><span id="card-bed"></span></p>
                        <p class="card-text" ><strong>Student Count:</strong> <span id="card-student"></span></p>
                        <div id="action-buttons" class="d-flex justify-content-between">
                            <button type="button" class="btn btn-success btn-half-width">Accept</button>
                            <button type="button" class="btn btn-danger btn-half-width">Reject</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 position-absolute bottom-0 w-100" >
        <?php include_once './components/footer.php';?>
    </div>
    <?php
    
    echo "<script>
      var coordinates = JSON.parse('$coordinatesJson');
    </script>";
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map("map").setView([6.82068, 80.04127], 17); // Adjust the view as needed
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);

            // Iterate over the coordinates and add a marker for each
            coordinates.forEach(function(coord) {
                var marker = L.marker([coord.lat, coord.lng]).addTo(map);
                marker.on('click', function() {
                    fetch('controllers/wardenController.php?prop_id=' + coord.id)
                        .then(response => response.json())
                        .then(data => {
                            // Assuming data contains 'Title', 'Description', etc.
                            // Update the #property-details container with the fetched data
                            document.getElementById('card-title').innerHTML = '';
                            document.getElementById('card-desc').innerHTML = '';
                            document.getElementById('card-address').innerHTML = '';
                            document.getElementById('card-keymoney').innerHTML = '';
                            document.getElementById('card-rent').innerHTML = '';
                            document.getElementById('card-bed').innerHTML = '';
                            document.getElementById('card-student').innerHTML = '';

                            document.getElementById('card-title').innerHTML = data.property.Title;
                            document.getElementById('card-desc').innerHTML = data.property.Description;
                            document.getElementById('card-address').innerHTML += data.property.Address;
                            document.getElementById('card-keymoney').innerHTML += data.property.Keymoney;
                            document.getElementById('card-rent').innerHTML += data.property.Rent;
                            document.getElementById('card-bed').innerHTML += data.property.BedCount;
                            document.getElementById('card-student').innerHTML += data.property.StdCount;
                            
                            // Clear existing carousel items
                            const carouselInner = document.getElementById('carouselExampleIndicators').querySelector('.carousel-inner');
                            carouselInner.innerHTML = ''; 

                            // Check if data.images exists and has length
                            if (!data.images || data.images.length === 0) {
                                // No images returned, add a default image
                                const carouselItem = document.createElement('div');
                                carouselItem.className = 'carousel-item active'; // Mark as active since it's the only item
                                carouselItem.innerHTML = `<img src="https://via.placeholder.com/400x200" class="d-block w-100" alt="No property image available">`;
                                carouselInner.appendChild(carouselItem);
                            } else {
                                // Images exist, iterate and add them to the carousel
                                data.images.forEach((img, index) => {
                                    const carouselItem = document.createElement('div');
                                    carouselItem.className = 'carousel-item' + (index === 0 ? ' active' : ''); // Mark the first item as active
                                    carouselItem.innerHTML = `<img src="${img.ImagePath}" class="d-block w-100" alt="Property image">`;
                                    carouselInner.appendChild(carouselItem);
                                });
                            }

                            // Check status and update buttons
                            const actionButtons = document.getElementById('action-buttons');
                            if(data.property.Status === 'Pending') {
                                actionButtons.innerHTML = `
                                    <a href="/acceptProperty?id=${data.property.PropertyID}" class="btn btn-success btn-half-width" role="button">Approve</a>
                                    <a href="/rejectProperty?id=${data.property.PropertyID}" class="btn btn-danger btn-half-width" role="button">Reject</a>
                                `;
                            } else if(data.property.Status === 'Approved') {
                                actionButtons.innerHTML = `
                                    <a href="/suspendProperty?id=${data.property.PropertyID}" class="btn btn-warning btn-half-width" role="button">Suspend</a>
                                    <a href="/deleteProperty?id=${data.property.PropertyID}" class="btn btn-danger btn-half-width" role="button">Delete</a>
                                `;
                            }else if(data.property.Status === 'Rejected') {
                                actionButtons.innerHTML = `
                                    <a href="/acceptProperty?id=${data.property.PropertyID}" class="btn btn-info btn-half-width" role="button">Re Approve</a>
                                    <a href="/deleteProperty?id=${data.property.PropertyID}" class="btn btn-danger btn-half-width" role="button">Delete</a>
                                `;

                            }
                            else if(data.property.Status === 'Suspended') {
                                actionButtons.innerHTML = `
                                    <a href="/acceptProperty?id=${data.property.PropertyID}" class="btn btn-info btn-half-width" role="button">Re Approve</a>
                                    <a href="/deleteProperty?id=${data.property.PropertyID}" class="btn btn-danger btn-half-width" role="button">Delete</a>
                                `;

                            }
                        })
                        .catch(error => {
                            console.error('Error fetching property details:', error);
                            // Optionally, display an error message in the property details section
                            document.getElementById('property-details').innerHTML = '<p>Error loading property details.</p>';
                        });
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>