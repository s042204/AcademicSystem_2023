<template>
  <div class="teacher-dashboard">
    <h2>Grade Management</h2>
    <form @submit.prevent="submitGrade">
      <select v-model="selectedStudent">
        <option disabled value="">Select a Student</option>
        <option v-for="student in students" :key="student.id" :value="student.id">
          {{ student.name }}
        </option>
      </select>

      <select v-model="selectedSubject">
        <option disabled value="">Select a Subject</option>
        <option v-for="subject in subjects" :key="subject.id" :value="subject.id">
          {{ subject.name }}
        </option>
      </select>

      <input type="number" v-model="grade" placeholder="Enter Grade">
      <button type="submit">Submit Grade</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'TeacherDashboard',
  data() {
    return {
      students: [], // This should be populated with student data
      subjects: [], // This should be populated with subject data
      isLoading: false,
      selectedStudent: '',
      selectedSubject: '',
      grade: null
    };
  },
  mounted() {
    this.fetchStudents();
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
    submitGrade() {
      if (!this.selectedStudent || !this.selectedSubject || this.grade === null) {
        alert('Please select a student, a subject, and enter a grade.');
        return;
      }

      const data = {
        studentId: this.selectedStudent,
        subjectId: this.selectedSubject,
        grade: this.grade
      };

      console.log("Submitting grade:", data);
      // Add logic to send data to the backend
      // For now, we'll just simulate a successful submission:
      setTimeout(() => {
        alert('Grade submitted successfully!');
        this.resetForm();
      }, 500);
    },
    resetForm() {
      this.selectedStudent = '';
      this.selectedSubject = '';
      this.grade = null;
    }
  }
};
</script>

<style></style>
