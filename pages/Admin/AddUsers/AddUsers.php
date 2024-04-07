<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">
  <link rel="stylesheet" href="<?php echo './pages/Admin/AddUsers/AddUsers.css';?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <title>Add Users</title>
</head>
<body>
  <div class="site-container">
    <div class="site-content">
      <?php include_once './components/navbar.php';?>
      <div class="container-fluid col-12 col-md-8 col-lg-6">
        <div id="login-form" class="d-flex flex-column align-items-center justify-content-center">
          <h1 class="text-center title"><i class="fa-solid fa-user-plus" style="color: #38B000;"></i> Add Users</h1>
          <div class="box col-8 text-white">
          <form action="/addUsers" method="POST">
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
            <button type="submit" class="btn btn-success" style="font-size: 18px;">Add User</button>
          </div>
        </form>
          </div>
        </div>
      </div>
    </div>
    <div class="foot">
      <?php include_once './components/footer.php';?>
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
        
        //make Student only inputs required
        const makeaInputRequired = (state) => {
            var authkey = document.getElementById('authkey');
            authkey.required = state;
        };
        
  </script>
  <!-- Import Bootstrap and jQuery -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>