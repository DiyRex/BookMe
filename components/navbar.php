<?php
@session_start();
echo <<<EOT
<!-- Navbar -->   
    <nav class="navbar navbar-expand-lg navobj">
      <div class="col-3 col-md-5">
        <a class="navbar-brand text-white" href="/">BoardMe</a>
      </div>
      <button
        class="togbtn navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="30"
          height="30"
          fill="white"
          class="bi bi-list"
          viewBox="0 0 16 16"
        >
          <path
            fill-rule="evenodd"
            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
          />
        </svg>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-3 mr-auto">
          <li class="nav-item active">
            <a class="nav-link text-white" href="/"
              >Home <span class="sr-only">(current)</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/explore">Explore</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">Contact US</a>
          </li>
        </ul>
        
EOT;
if (isset($_SESSION['email']) && $_SESSION['loggedin'] == true) {
  $email = $_SESSION['email'];
  echo <<<EOT
  <div class="dropdown show">
  <a class="btn btn-outline-success my-2 my-sm-0 text-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    $email
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="/logout">Logout</a>
  </div>
</div>";
EOT;
} else {
  echo '<a class="btn btn-outline-success my-2 my-sm-0 text-white" href="/auth" type="submit">Login/Signup</a>';
}

echo "</div>
    </nav>";
