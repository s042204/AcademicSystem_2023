<template>
    <div class="student-management-container">
        <h2>Student Management</h2>
        <div class="form-container">
            <form @submit.prevent="createStudent" class="student-form">
                <input type="text" v-model="newStudent.name" placeholder="Student's Name" class="form-field">
                <input type="text" v-model="newStudent.surname" placeholder="Student's Surname" class="form-field">
                <button type="submit" class="submit-button">Create Student</button>
            </form>
        </div>
        <div class="table-container">
            <table class="students-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Group</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="student in students" :key="student.id">
                        <td>{{ student.name }}</td>
                        <td>{{ student.surname }}</td>
                        <td>
                            <select v-model="student.group_id" @change="updateStudentGroup(student)" class="group-select">
                                <option disabled value="">Select a Group</option>
                                <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.group_name }}
                                </option>
                            </select>
                        </td>
                        <td>
                            <button @click="deleteStudent(student.id)" class="delete-button">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>
import adminDashService from './services/adminDashService';

export default {
    name: 'StudentManagement',
    data() {
        return {
            newStudent: {
                name: '',
                surname: '',
                group_id: null
            },
            students: adminDashService.loadStudents(),
            groups: [], 
        };
    },
    mounted() {
        this.groups = adminDashService.loadGroups();
    },
    methods: {
        createStudent() {
            if (!this.newStudent.name || !this.newStudent.surname) {
                alert("Please enter both name and surname.");
                return;
            }
            const createdStudent = adminDashService.createStudent(this.newStudent);
            this.students.push(createdStudent);
            this.newStudent.name = '';
            this.newStudent.surname = '';
            this.newStudent.group_id = null;
        },
        deleteStudent(studentId) {
            if (!confirm("Are you sure you want to delete this student?")) {
                return;
            }
            adminDashService.deleteStudent(studentId);
            this.students = this.students.filter(student => student.id !== studentId);
        },
        updateStudentGroup(student) {
            adminDashService.updateStudentGroup(student.id, student.group_id);
            const updatedStudent = this.students.find(s => s.id === student.id);
            if(updatedStudent) updatedStudent.group_id = student.group_id;
        },

    }
};
</script>

<!-- <script>
import adminDashboardService from './services/adminDashboardService';

export default {
    name: 'StudentManagement',
    data() {
        return {
            newStudent: {
                name: '',
                surname: '',
                group_id: '',
                role: 'student'
            },
            students: [],
            groups: []
        };
    },
    created() {
        this.fetchStudents();
        this.fetchGroups();
    },
    methods: {
        createStudent() {
            if (!this.newStudent.name.trim() || !this.newStudent.surname.trim()) {
                alert("Please enter both name and surname.");
                return;
            }
            adminDashboardService.createStudent(this.newStudent)
                .then(() => {
                    alert("Student created successfully!");
                    this.newStudent.name = '';
                    this.newStudent.surname = '';
                    this.newStudent.group_id = '';
                    this.fetchStudents();
                })
                .catch(error => {
                    alert("Error creating student: " + error.message);
                    console.error(error.response);
                });
        },
        getGroupName(groupId) {
            const group = this.groups.find(g => g.id === groupId);
            return group ? group.group_name : 'Not assigned';
        },
        fetchStudents() {
            adminDashboardService.getStudents()
                .then(response => {
                    this.students = response.data
                        .filter(user => user.role === 'student')
                        .map(student => ({
                            ...student,
                            group_name: this.getGroupName(student.group_id),
                        }));
                })
                .catch(error => {
                    console.error("Error fetching students:", error.response);
                });
        },
        fetchGroups() {
            adminDashboardService.getGroups()
                .then(response => {
                    this.groups = response.data;
                })
                .catch(error => {
                    console.error("Error fetching groups:", error.response);
                });
        },
        deleteStudent(studentId) {
            if (!confirm("Are you sure you want to delete this student?")) {
                return;
            }

            adminDashboardService.deleteStudent(studentId)
                .then(() => {
                    alert("Student deleted successfully!");
                    this.fetchStudents();
                })
                .catch(error => {
                    alert("Error deleting student: " + error.message);
                    console.error(error.response);
                });
        },
        updateStudentGroup(student) {
            const groupId = student.group_id || null;
            adminDashboardService.updateStudentGroup(student.id, groupId)
                .then(() => {
                    alert("Student group updated successfully!");
                    this.fetchStudents();
                })
                .catch(error => {
                    alert("Error updating student group: " + error.message);
                    console.error(error.response);
                });
        },
    }
};
</script> -->

<style scoped>
.student-management-container {
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.student-form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.form-field {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    flex-grow: 1;
}

.submit-button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50; 
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.submit-button:hover {
    background-color: #45a049; 
}

.students-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.students-table th,
.students-table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

.students-table th {
    background-color: #009688; 
    color: white;
}

.group-select {
    padding: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
    width: calc(100% - 22px); 
}

.delete-button {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    background-color: #f44336;
    color: white;
    cursor: pointer;
}

.delete-button:hover {
    background-color: #d32f2f; 
}

</style>
