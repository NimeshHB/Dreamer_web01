// user ui js for func ctrl

  const AuthUtils = {
    secretKey: "Test@2025",

    generateKey(fields) {
      const message = fields.join('');
      return CryptoJS.HmacSHA256(message, this.secretKey).toString(CryptoJS.enc.Hex);
    },

    async postRequest(url, data) {
      try {
        const response = await fetch(window.location.origin + url, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
        });
        const result = await response.json();
        alert(result.message);
      } catch (error) {
        console.error("Error:", error);
        alert("Request failed.");
      }
    }
  };

  async function submitLogin() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    if (!email || !password) {
      alert("Please enter both email and password.");
      return;
    }

    const key = AuthUtils.generateKey([email, password]);

    const postData = { email, password, key };
    await AuthUtils.postRequest('/api/login', postData);
  }

  async function submitRegister() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const mobile = document.getElementById('mobile').value.trim();

    if (!name || !email || !mobile) {
      alert("Please fill in all fields.");
      return;
    }

    const key = AuthUtils.generateKey([name, email, mobile]);

    const postData = { name, email, mobile, key };
    await AuthUtils.postRequest('/api/register', postData);
  }