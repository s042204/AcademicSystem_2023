<template>
    <div class="admin-panel">
      <h2>Admin Panel</h2>
      <div>
        <h3>Registered Users</h3>
        <ul>
          <li v-for="user in users" :key="user.id">
            {{ user.name }} ({{ user.username }}) - <button @click="deleteUser(user.id)">Delete User</button>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AdminDashboard',
    data() {
      return {
        users: [
          { id: 1, name: 'John Doe', username: 'johndoe' },
          { id: 2, name: 'Jane Doe', username: 'janedoe' }
        ]
      };
    },
    methods: {
      deleteUser(userId) {
        this.users = this.users.filter(user => user.id !== userId);
      }
    }
  }
  </script>
  
  <style>
  .admin-dashboard {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
  }
  </style>
  