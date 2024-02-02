<template>
  <div class="main-dashboard">
    <div class="dashboard-header">
      <span class="user-greeting">{{ greetingMessage }}</span>
      <router-link to="/profile">
        <button class="dashboard-button">My Profile</button>
      </router-link>
      <button @click="logout" class="dashboard-button">Logout</button>
    </div>


    <h1>Academic System</h1>

    <student-dashboard v-if="isStudent"> </student-dashboard>
    <teacher-dashboard v-if="isTeacher"> </teacher-dashboard>
    <admin-dashboard v-if="isAdmin"> </admin-dashboard>

  </div>
</template>

<script>
import StudentDashboard from '../components/StudentDashboard.vue';
import TeacherDashboard from '../components/TeacherDashboard.vue';
import AdminDashboard from '../components/AdminDashboard.vue';
import http from '../components/services/http.js';

http.get('/users')
    .then(response => {
    })
    .catch(error => {
    });


export default {
  components: {
    StudentDashboard,
    TeacherDashboard,
    AdminDashboard,
  },
  name: 'MainDashboard',
  data() {
    return {
      isAdmin: false,
      isStudent: false,
      isTeacher: false,
      greetingMessage: '',
    };
  },
  created() {
  this.setUserRoleAndGreeting();
},

methods: {
  setUserRoleAndGreeting() {
    const userRole = localStorage.getItem('userRole');
    const userName = localStorage.getItem('userName');

    if (userRole && userName) {
      this.isAdmin = userRole === 'admin';
      this.isStudent = userRole === 'student';
      this.isTeacher = userRole === 'teacher';
      this.greetingMessage = `Welcome ${userName} (${userRole})!`;
    } else {
      console.error('User role or name not found in local storage');
      this.$router.push('/login');
    }
  },
  logout() {
    localStorage.removeItem('userRole');
    localStorage.removeItem('userName');
    this.$router.push('/login');
  }
}
}

</script>
  
<style>
.main-dashboard {
  display: flex;
  flex-direction: column;
  justify-content: center;
  min-height: 100vh;
  padding: 20px;
  background: #f4f4f4;
}

.dashboard-header {
  background-color: #088F8F;
  color: white;
  padding: 10px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.user-greeting {
  font-size: 18px;
  margin-right: 20px;
}

.dashboard-button {
  padding: 10px 20px;
  margin-left: 10px;
  border: none;
  border-radius: 5px;
  background-color: #066666;
  color: white;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.dashboard-button:hover {
  background-color: #90EE90;
}
</style>

<!-- localStorage.setItem('userRole', 'admin'); -->
