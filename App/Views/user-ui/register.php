<div class='user-layout-body'>
  <div class="user-layout-login-box">
    <a href="../../home">
      <img src="assets/img/logo/academy%20logo-09.svg" alt="Dreamer Nihongo Academy" class="user-layout-login-logo">
    </a>
    <h2>User Creation - Request</h2>

    <!-- <form action="" method="post"> -->
      <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" required>
      <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
      <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>

      <button onclick="submitRegister()" class="btn user-layout-btn-red">Register</button>

      <div class="user-layout-form-link mt-3">
        Do have an account? <a href="../../login">Login</a>
      </div>

      <!-- Preloader -->
      <div id="user-ui-preloader" class="hidden user-ui-preloader-fullscreen">
        <div class="user-ui-spinner"></div>
      </div>

      <!-- Toast Message -->
      <div id="user-ui-toast-container"></div>

    <!-- </form> -->
  </div>
</div>

