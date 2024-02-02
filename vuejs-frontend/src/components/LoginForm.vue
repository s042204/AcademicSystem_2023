<template>
  <div class="login-form">
    <h2>Login</h2>
    <form @submit.prevent="login">
      <div class="form-group">
        <label for="username">Username:</label>
        <input id="username" class="input-field" v-model="username" type="text" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input id="password" class="input-field" v-model="password" type="password" required>
      </div>
      <div class="form-actions">
        <button class="form-button" type="submit">Login</button>
      </div>
    </form>
  </div>
</template>

<script>
import http from '../components/services/http.js';

export default {
  name: 'LoginForm',
  data() {
    return {
      username: '',
      password: ''
    };
  },
  methods: {
    login() {
      http.post('/login', {
        username: this.username,
        password: this.password
      })
        .then(response => {
          console.log(response);
          localStorage.setItem('userRole', response.data.user.role);
          localStorage.setItem('userName', response.data.user.name);
          this.$router.push('/dashboard');
        })
        .catch(error => {
          console.error(error);
          alert('Login failed. Please try again.');
        });
    }
  }
}
</script>


<style scoped>
.login-form {
  display: flex;
  flex-direction: column;
  max-width: 400px;
  margin: 50px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 10px;
  background: white;
}

.login-form h2 {
  color: #333;
  text-align: center;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  width: calc(100% - 20px);
  border-radius: 5px;
  font-size: 16px;
}

.form-button {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: #ADD8E6;
  color: white;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
  width: 100%;
  box-sizing: border-box;
}

.form-button:hover {
  background-color: #45a049;
}

.input-field,
.form-button {
  padding: 10px;
  margin-bottom: 10px;
}

.input-field:focus,
.form-button:focus {
  outline: none;
  border-color: #ADD8E6;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(173, 216, 230, 0.5);
}

.form-actions {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.form-link {
  margin-top: 10px;
  color: #088F8F;
  text-decoration: none;
}

.form-link:hover {
  text-decoration: underline;
}

.register-link {
  text-align: center;
  margin-top: 20px;
}

.register-link p {
  margin-bottom: 5px;
}

@media (max-width: 768px) {
  .login-form {
    width: 90%;
    margin: 20px auto;
  }
}</style>
