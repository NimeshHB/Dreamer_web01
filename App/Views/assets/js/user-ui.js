// user ui js for func ctrl

  const AuthUtils = {
    secretKey: "Test@2025",

    generateKey(fields) {
      const message = fields.join('');
      return CryptoJS.HmacSHA256(message, this.secretKey).toString(CryptoJS.enc.Hex);
    },

    showToast(message, type) {
      const toast = document.createElement('div');
      toast.className = `user-ui-toast ${type}`;
      toast.innerText = message;
      document.getElementById('user-ui-toast-container').appendChild(toast);
      setTimeout(() => {
        toast.remove();
      }, 5000);
    },

    togglePreloader(show = true) {
      document.getElementById('user-ui-preloader').classList.toggle('hidden', !show);
    },

    async postRequest(url, data) {
      this.togglePreloader(true);

      try {
        const response = await fetch(window.location.origin + url, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
        });

        const result = await response.json();
        this.showToast(result.message, result.status);
      } catch (error) {
        console.error("Error:", error);
        this.showToast("Request failed.", 'error');
      } finally {
        this.togglePreloader(false);
      }
    }
  };

  async function submitLogin() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    if (!email || !password) {
      AuthUtils.showToast("Please enter both email and password.", 'error');
      return;
    }

    const key = AuthUtils.generateKey([email, password]);
    const postData = { email, password, key };
    await AuthUtils.postRequest('/api/login', postData);
  }

  async function submitRegister() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!name || !email || !password) {
      AuthUtils.showToast("Please fill in all fields.", 'error');
      return;
    }

    const key = AuthUtils.generateKey([name, email, password]);
    const postData = { name, email, password, key };
    await AuthUtils.postRequest('/api/register', postData);
  }

