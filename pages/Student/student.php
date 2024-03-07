<?php
@session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['role'] !== "Student"){
  header('Location: /');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1" />
  <link rel="stylesheet" href="./pages/Student/student.css" />
  <link rel="stylesheet" href="../../components/navbar.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <title>Student</title>
</head>

<body>
  <?php include_once './components/navbar.php'; ?>

  <div class="container-fluid main-container">
    <h2 class="mtitle text-center mt-3 mt-md-5">
      <i class="fa-solid fa-location-dot"></i> Explore
      <span style="color: #38b000">Boarding</span>
    </h2>
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-11 col-md-8">
        <div class="m-3" id="map" style="height: 700px; width: auto"></div>
        <input type="hidden" id="advCoordinates" value="" />
      </div>
      <div class="col-10 col-md-4">

        <div class="card-container d-flex flex-column justify-content-center align-items-center mx-1 p-3">
          <div class="image-section w-100 d-flex justify-content-center mb-1 px-3">
            <div class="img1"></div>
            <div class="img2"></div>
          </div>
          <div class="title-desc">
            <h3 class="h3-tag">Green Villa Hostel</h3>
            <h5 class="h5-tag text-center">A hostel for 5 boys</h5>
          </div>
          <div class="address mb-2">
            <h4 class="h4-tag">42/b Pitipana Road, Homagama</h4>
          </div>
          <div class="count d-flex align-items-center justify-content-center">
            <div class="d-flex ">
              <i class="fa-solid fa-bed size"></i>
              <h4 class="ml-3 mt-1 h4-tag">5</h4>
            </div>
            <div class="ml-5 d-flex">
              <i class="fa-solid fa-male ml-2 size"></i>
              <h4 class="ml-3 mt-1 h4-tag">5</h4>
            </div>
          </div>
          <div class="price d-flex flex-column text-center mt-2">
            <div class="owner d-flex">
              <h4 class="h4-tag">Owner : </h4>
              <h4 class="h4-tag">Mr Fernando</h4>
            </div>
            <div class="rent d-flex">
              <h4 class="h4-tag">Rent : </h4>
              <h4 class="h4-tag">LKR 40 000</h4>
            </div>
            <div class="keymoney d-flex">
              <h4 class="h4-tag">Key Money : </h4>
              <h4 class="h4-tag">LKR 50 000</h4>
            </div>
          </div>
          <div class="btn-section">
            <button class="btn-contact">Contact Now</button>
            <button class="btn-book">Book Now</button>
          </div>
        </div>
      </div>
    </div>
    <?php
    echo "<script>
      var coordinates = $coordinatesJson;
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
          L.marker([coord.lat, coord.lng]).addTo(map);
        });
      });
    </script>
    <!-- Import Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>