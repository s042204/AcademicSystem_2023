<template>
  <div class="user-profile">
    <h2>User Profile</h2>
    <div v-if="user">
      <div class="profile-picture">
        <img :src="profilePictureUrl" alt="Profile Picture">
        <input type="file" @change="uploadProfilePicture" accept="image/*">
      </div>
      <div>
        <router-link to="/history">
          <button class="form-button">View Purchase History</button>
        </router-link>
      </div>
      <p><strong>Username:</strong> {{ user.username }}</p>
      <p><strong>Name:</strong> {{ user.name }}</p>
      <p><strong>Surname:</strong> {{ user.surname }}</p>
      <p><strong>Date of Birth:</strong> {{ formattedDateOfBirth }}</p>

      <div v-if="showChangePassword">
        <h3>Change Password</h3>
        <input type="password" v-model="currentPassword" placeholder="Current Password"><br>
        <input type="password" v-model="newPassword" placeholder="New Password"><br>
        <input type="password" v-model="confirmPassword" placeholder="Confirm New Password"><br>
        <button @click="changePassword">Submit New Password</button>
        <p v-if="passwordError" class="error-message">{{ passwordError }}</p>
      </div>
      <button @click="showChangePasswordForm" v-if="!showChangePassword">Change Password</button>
    </div>
    <div>
      <button @click="goBack" class="button-back form-button">Back to Shop</button>
      <button @click="saveProfile" class="button-save form-button">Save</button>
    </div>
  </div>
</template>

<script>

export default {
  name: 'UserProfile',
  data() {
    return {
      user: {
        username: '',
        name: '',
        surname: '',
        dob: '',
        profilePictureUrl: '',
      },
      currentPassword: '',
      newPassword: '',
      showChangePassword: false,
    };
  },
  mounted() {
    const savedUserData = JSON.parse(localStorage.getItem('userData'));
    if (savedUserData) {
      this.user = savedUserData;
      this.profilePictureUrl = localStorage.getItem('profilePicture');
    }
  },
  computed: {
    formattedDateOfBirth() {
      if (!this.user || !this.user.dob) return '';
      return new Date(this.user.dob).toLocaleDateString();
    },
  },
  methods: {
    uploadProfilePicture(event) {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.profilePictureUrl = e.target.result;
        localStorage.setItem('profilePicture', this.profilePictureUrl);
      };
      reader.readAsDataURL(event.target.files[0]);
    },
    showChangePasswordForm() {
      this.showChangePassword = true;
    },
    changePassword() {
      if (this.newPassword !== this.confirmPassword) {
        this.passwordError = 'Passwords do not match';
        return;
      }
      if (this.newPassword.length < 8) {
        this.passwordError = 'Password must be at least 8 characters long';
        return;
      }
      if (this.newPassword === this.currentPassword) {
        this.passwordError = 'New password must be different from current password';
        return;
      }
      this.passwordError = '';
      this.user.password = this.newPassword;
      localStorage.setItem('userData', JSON.stringify(this.user));
      this.showChangePassword = false;

    },
    saveProfile() {
      localStorage.setItem('userData', JSON.stringify(this.user));
      this.$router.push('/dashboard'); // Assuming '/dashboard' is the correct path
    },
    goBack() {
      this.$router.push('/dashboard'); // Navigate back to the dashboard
    },
  },
}
</script>

<style scoped>
.user-profile {
  display: flex;
  flex-direction: column;
  max-width: 400px;
  margin: 50px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 10px;
  background: white;
}

.user-profile h2,
.user-profile h3 {
  text-align: center;
  margin-bottom: 20px;
}

.profile-picture {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 20px;
}

.profile-picture img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 50%;
  margin-bottom: 10px;
}

.profile-picture input[type="file"] {
  margin-top: 10px;
}

button {
  padding: 10px 20px;
  margin-top: 10px;
  border: none;
  border-radius: 5px;
  background-color: #ADD8E6;
  color: white;
  font-size: 12px;
  cursor: pointer;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #45a049;
}

.error-message {
  color: red;
  margin-top: 10px;
}

.input-field {
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  margin-bottom: 10px;
}

.input-field:focus {
  outline: none;
  border-color: #ADD8E6;
  box-shadow: 0 0 5px rgba(173, 216, 230, 0.5);
}

.user-profile input[type="password"] {
  width: calc(100% - 20px);
  display: block;
}

.button-back,
.button-save {
  padding: 10px 20px;
  margin-top: 10px;
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

.button-back {
  background-color: transparent;
  color: #333;
  border: 1px solid #ccc;
}

.button-back:hover {
  background-color: #ccc;
  color: white;
}

.button-save:hover {
  background-color: #45a049;
}
</style>