<template>
  <div class="admin-dashboard">
    <button @click="toggleComponent('groupManagement')" class="dashboard-toggle-button">Group Management</button>
    <group-management v-if="activeComponent === 'groupManagement'"></group-management>
    
    <button @click="toggleComponent('subjectManagement')" class="dashboard-toggle-button">Subject Management</button>
    <subject-management v-if="activeComponent === 'subjectManagement'"></subject-management>
    
    <button @click="toggleComponent('teacherManagement')" class="dashboard-toggle-button">Teacher Management</button>
    <teacher-management v-if="activeComponent === 'teacherManagement'"></teacher-management>

    <button @click="toggleComponent('studentManagement')" class="dashboard-toggle-button">Student Management</button>
    <student-management v-if="activeComponent === 'studentManagement'"></student-management>
  </div>
</template>

<script>
import GroupManagement from './GroupManagement.vue';
import SubjectManagement from './SubjectManagement.vue';
import TeacherManagement from './TeacherManagement.vue';
import StudentManagement from './StudentManagement.vue';

export default {
  name: 'AdminDashboard',
  data() {
    return {
      activeComponent: null,
    };
  },
  methods: {
    toggleComponent(component) { 
      this.activeComponent = component;
    }
  },
  components: {
    GroupManagement,
    SubjectManagement,
    TeacherManagement,
    StudentManagement
  }
};
</script>


<style>
.admin-dashboard {
  display: flex;
  flex-direction: column;
  padding: 20px;
  background: #f4f4f4;
}

.dashboard-toggle-button {
  padding: 10px 20px;
  margin-bottom: 10px;
  border: none;
  border-radius: 5px;
  background-color: #066666;
  color: white;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.dashboard-toggle-button:hover {
  background-color: #90EE90;
}

.dashboard-toggle-button:not(:last-child) {
  margin-bottom: 10px;
}
</style>
