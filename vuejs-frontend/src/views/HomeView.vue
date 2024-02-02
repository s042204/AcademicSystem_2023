<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/App.png">
    <div>
      <p>Praktinis darbas 2</p>
      <p>Academic System</p>
    </div> 
    <div>
      <router-link to="/login">
        <button class="home-button">
          Login
        </button>
      </router-link>
      <!-- <router-link to="/register">
        <button class="home-button">
          Register
        </button>
      </router-link> -->
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomeView',
  methods: {
    continueAsGuest() {
      this.$router.push({ name: 'Dashboard', params: { isGuest: true } });
    },
  },
};
</script>

<style scoped>
.home {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: top;
  min-height: 100vh;
  padding: 20px;
  background: #f4f4f4;
}

.home img {
  max-width: 300px;
  margin-bottom: 30px;
}

.home > div {
  text-align: center;
  margin-bottom: 20px;
}

.home p {
  font-size: 24px;
  margin: 0;
  line-height: 1.2;
}

.home-button {
  padding: 10px 20px;
  margin: 0 10px;
  border: none;
  border-radius: 5px;
  background-color: #066666;
  color: white;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
  white-space: nowrap;
}

.home-button:hover {
  background-color: #048f8f;
}

.home > div + div {
  margin-top: 30px;
}
</style>



