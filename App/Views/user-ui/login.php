
<div class='user-layout-body'>
  <div class="user-layout-login-box">
    <a href="../../home">
      <img src="assets/img/logo/academy%20logo-09.svg" alt="Dreamer Nihongo Academy" class="user-layout-login-logo">
    </a>
    <h2>Welcome Back</h2>

    <!-- <form method="post"> -->
      <input type="email" name="email" id="username" class="form-control" placeholder="Email" required>
      <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

      <div class="user-layout-form-link text-end">
        <a href="#">Forgot Password?</a>
      </div>

      <button class="btn user-layout-btn-red" onclick="submitLogin()">Log In</button>

      <div class="user-layout-form-link mt-3">
        Don’t have an account? <a href="../../register">Sign Up</a>
      </div>
    <!-- </form> -->
  </div>
</div>


<script>
  const secretKey = "Test@2025";  // Shared secret key

  function generateKey(username, password) {
    const message = username + password;
    return CryptoJS.HmacSHA256(message, secretKey).toString(CryptoJS.enc.Hex);
  }

  async function submitLogin() {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;

    if (!username || !password) {
      alert("Please enter both email and password.");
      return;
    }

    const key = generateKey(username, password);

    const postData = {
      username: username,
      password: password,
      key: key
    };

    fetch(window.location.origin + '/api/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(postData)
    })
    .then(res => res.json())
    .then(data => {
      alert(data.message);
    })
    .catch(err => {
      console.error("Error:", err);
      alert("Login failed.");
    });
  }

</script>