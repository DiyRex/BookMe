<?php include_once './helpers/dbConn.php'?>
<!DOCTYPE html>
<!-- change homescreen data according to role based -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1"
    />
    <link rel="stylesheet" href="./pages/HomePage/Home.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
  </head>
  <body>
    <?php include_once "./components/navbar.php" ?>

    <!-- hero section -->
    <section>
      <div class="col-12 d-flex">
        <div
          class="col-12 col-md-6 w-full d-flex flex-column align-items-md-center justify-content-md-center vh100"
        >
          <div class="d-flex flex-column align-items-md-center">
            <h2 class="title">
              Hey <span style="color: #38b000"><?= $_SESSION['role'] ?? 'Students' ?>!</span>
            </h2>
            <p class="desc text-center">
              Are you looking for some accommodation Until become an
              undergraduate.
            </p>
          </div>
            <div
              class="button-section d-flex flex-row align-items-center justify-content-center mt-2"
            >
            <?php
            if(isset($_SESSION['role'])){
              if($_SESSION['role'] == "Student"){
                echo '<a href="/explore" class="btn-more-info">Find a Place</a>
                <a class="mx-2 btn-find-place">More info</a>';
              }else if($_SESSION['role'] == "Warden"){
                echo '<a href="/explore" class="btn-more-info">Advertisements</a>
                <a class="mx-2 btn-find-place">More info</a>';
              }else if($_SESSION['role'] == "Admin"){
                echo '<a href="/explore" class="btn-more-info">Dashboard</a>
                <a href="/" class="mx-2 btn-find-place">More info</a>
              ';
              }
            }else{
              echo '<button class="btn-more-info">More Info</button>
              <button class="mx-2 btn-find-place">Find A Place</button>';
            }
            ?>
            </div>
          <img
            class="hero-img-sm d-md-none"
            src="./pages/HomePage/images/keytagf.png"
            alt=""
          />
        </div>
        <div
          class="d-none d-md-block col-md-6 col-sm-6 overflow-hidden hero-img-div"
        >
          <img class="hero-img" src="./pages/HomePage/images/keytagf.png" alt="" />
        </div>
      </div>
    </section>

    <!-- puropose section -->
    <section>
      <div class="col-12 d-flex flex-column align-items-center ">
        <div class="content d-flex flex-column align-items-center">
          <h2 class="mb-5">PURPOSE</h2>
          <p class="desc text-center">Your Ultimate Destination for Student Boarding Solutions. Effortlessly find your ideal student accommodation with us.</p>
        </div>
        <div class="img-wrapper">
          <img class="purpose-image" src="./pages/HomePage/images/rent.png" alt="">
        </div>
      </div>
    </section>

    <?php include_once './components/footer.php'?>

    <!-- Import Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>