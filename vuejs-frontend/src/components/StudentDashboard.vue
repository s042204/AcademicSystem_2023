<template>
    <div class="student-dashboard">
      <h2>My Grades</h2>
      <div v-if="subjects.length > 0">
        <table>
          <thead>
            <tr>
              <th>Subject</th>
              <th>Grade</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="subject in subjects" :key="subject.id">
              <td>{{ subject.name }}</td>
              <td>{{ getGrade(subject.id) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <p>No grades available.</p>
      </div>
    </div>
</template>

<script>
export default {
  name: 'StudentDashboard',
  data() {
  return {
    subjects: [],
    isLoading: false,
  };
},
mounted() {
  this.fetchSubjectsAndGrades();
},
methods: {
  fetchSubjectsAndGrades() {
    this.isLoading = true;
    // Simulate fetching data
    setTimeout(() => { // Replace this with an actual API call
      this.subjects = [
        { id: 1, name: 'Mathematics', grade: 'B' },
        // ... other subjects
      ];
      this.isLoading = false;
    }, 1000);
  },
  getGrade(subjectId) {
    const subject = this.subjects.find(subject => subject.id === subjectId);
    return subject ? subject.grade : 'N/A';
  },
}
};
</script>

<style>
</style>
