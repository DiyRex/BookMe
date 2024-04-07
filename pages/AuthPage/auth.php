<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">
  <link rel="stylesheet" href="./pages/AuthPage/auth.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <title>BookMe Login</title>
</head>

<body>
  <?php include_once './components/navbar.php';?>
  <div class="container-fluid col-12 col-md-8 col-lg-6">
    <div id="login-form" class="d-flex flex-column align-items-center justify-content-center">
      <h1 class="text-center title"><i class="fa-solid fa-lock" style="color: #38B000;"></i> Login</h1>
      <div class="box col-10 col-lg-6 col-md-8 text-white">
        <form action="/auth" method="POST">
          <input type="hidden" name="mode" value="login">
          <div class="form-group py-2">
            <label for="inlineFormInputGroupUsername">Email</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa-regular fa-at" style="color: #38B000;"></i></div>
              </div>
              <input type="email" class="form-control" id="inlineFormInputGroupUsername" placeholder="Email" name="email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa-solid fa-key" style="color: #38B000;"></i></div>
              </div>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
            </div>
          </div>
          <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-success py-2 px-4">Login</button>
          </div>
        </form>
        <div class="d-flex justify-content-center mt-3 mb-3">
          <h4 class="mt-3" style="font-size: small;">Don’t have an account? <a id="showSignup" style="color: #38B000; cursor:pointer;">Sign Up</a></h4>
        </div>
      </div>
    </div>

    <!-- signup -->

    <div id="signup-form" class="d-none flex-column align-items-center justify-content-center">
      <h1 class="text-center title"><i class="fa-solid fa-lock" style="color: #38B000;"></i> Sign Up</h1>
      <div class="box col-10 col-lg-6 col-md-8 mb-5 text-white">
        <form action="/auth" method="POST">
          <input type="hidden" name="mode" value="signup">
          <div class="form-group">
            <label for="inputName">Name</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa-solid fa-signature" style="color: #38B000;"></i></div>
              </div>
              <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputNIC">NIC</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa-solid fa-address-card" style="color: #38B000;"></i></div>
              </div>
              <input type="text" class="form-control" id="inputNIC" name="nic" placeholder="NIC" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Address</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa-solid fa-house" style="color: #38B000;"></i></div>
              </div>
              <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputContact">Contact</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa-solid fa-phone" style="color: #38B000;"></i></div>
              </div>
              <input type="text" class="form-control" id="inputContact" name="contact" placeholder="Contact" required>
            </div>
          </div>
          <div class="form-group">
            <label for="roleSelect">Role</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa-solid fa-user" style="color: #38B000;"></i></div>
              </div>
              <select class="form-control" id="roleSelect" name="role" required>
                <option selected value="">Choose...</option>
                <option value=1>Student</option>
                <option value=2>Landlord</option>
                <option value=3>Warden</option>
                <option value=4>Admin</option>
              </select>
            </div>
          </div>
          <!-- student only -->
          <div id="studentOnly" class="d-none">
            <div class="form-group">
              <label for="roleSelect">Degree Duration</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa-solid fa-clock" style="color: #38B000;"></i></div>
                </div>
                <select class="form-control" id="degDuration" name="degreeDuration">
                  <option selected value="">Choose...</option>
                  <option value=1>1 Year</option>
                  <option value=2>2 Years</option>
                  <option value=3>3 Years</option>
                  <option value=4>4 Years</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail">University ID</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa-solid fa-id-card" style="color: #38B000;"></i></div>
                </div>
                <input type="text" class="form-control" id="inputUniID" name="uniID" placeholder="University ID">
              </div>
            </div>
          </div>
          <!--  -->
          <!-- Admin only -->
          <div id="adminOnly" class="d-none">
            <div class="form-group">
              <label for="inputEmail">Authkey</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa-solid fa-key" style="color: #38B000;"></i></div>
                </div>
                <input type="text" class="form-control" id="authkey" name="authkey" placeholder="Authkey">
              </div>
            </div>
          </div>
          <!--  -->
          <div class="form-group">
            <label for="inputEmail">Email</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa-solid fa-at" style="color: #38B000;"></i></div>
              </div>
              <input type="email" class="form-control" id="inputEmail" name="signup_email" placeholder="Email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword">Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa-solid fa-key" style="color: #38B000;"></i></div>
              </div>
              <input type="password" class="form-control" id="inputPassword" name="signup_password" placeholder="Password" required>
            </div>
          </div>
          <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-success">Sign Up</button>
          </div>
        </form>
        <div class="d-flex justify-content-center  mt-3 mb-5">
          <h4 class="mt-3" style="font-size: small;">Already have an account? <a id="showLogin" style="color: #38B000; cursor:pointer;">Login</a></h4>
        </div>
      </div>
    </div>

  </div>
  <script>
    // student only
    var role = document.getElementById('roleSelect');
    role.addEventListener('change', function() {
      var selectedRole = role.value;
      if (selectedRole == 1) {
        document.getElementById('studentOnly').classList.remove('d-none');
        document.getElementById('studentOnly').classList.add('d-block');
        makeInputRequired(true);
      } else {
        document.getElementById('studentOnly').classList.remove('d-block');
        document.getElementById('studentOnly').classList.add('d-none');
        makeInputRequired(false);
      }
    })

    //make Student only inputs required
    const makeInputRequired = (state) => {
      var degDur = document.getElementById('degDuration');
      var uniID = document.getElementById('inputUniID');
      degDur.required = state;
      uniID.required = state;
    }
    // admin only
    var role = document.getElementById('roleSelect');
    role.addEventListener('change', function() {
      var selectedRole = role.value;
      if (selectedRole == 4) {
        document.getElementById('adminOnly').classList.remove('d-none');
        document.getElementById('adminOnly').classList.add('d-block');
        makeInputRequired(true);
      } else {
        document.getElementById('adminOnly').classList.remove('d-block');
        document.getElementById('adminOnly').classList.add('d-none');
        makeInputRequired(false);
      }
    })

    //make Student only inputs required
    const makeaInputRequired = (state) => {
      var authkey = document.getElementById('authkey');
      authkey.required = state;
    }


    document.getElementById('showSignup').addEventListener('click', function() {
      document.getElementById('login-form').classList.remove('d-flex')
      document.getElementById('login-form').classList.add('d-none')
      document.getElementById('signup-form').classList.remove('d-none')
      document.getElementById('signup-form').classList.add('d-flex')
    });

    document.getElementById('showLogin').addEventListener('click', function() {
      document.getElementById('signup-form').classList.remove('d-flex')
      document.getElementById('signup-form').classList.add('d-none')
      document.getElementById('login-form').classList.remove('d-none')
      document.getElementById('login-form').classList.add('d-flex')
    });
  </script>
  <!-- Import Bootstrap and jQuery -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>