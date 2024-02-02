<template>
    <div class="subject-management">
        <h2>Subject Management</h2>
        <div class="form-container">
            <form @submit.prevent="createSubject" class="subject-form">
                <input type="text" v-model="newSubject.subject_name" placeholder="Subject Name" class="form-field">
                <button type="submit" class="submit-button">Add Subject</button>
            </form>
        </div>
        <div class="table-container">
            <table class="subjects-table">
                <thead>
                    <tr>
                        <th>Subject Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="subject in subjects" :key="subject.id">
                        <td>{{ subject.subject_name }}</td>
                        <td>
                            <button @click="deleteSubject(subject.id)" class="delete-button">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import adminDashService from "./services/adminDashService";

export default {
    name: 'SubjectManagement',
    data() {
        return {
            newSubject: {
                subject_name: '',
            },
            subjects: [], 
        };
    },
    created() {
        this.subjects = adminDashService.loadSubjects();
    },
    methods: {
        createSubject() {
            if (!this.newSubject.subject_name) {
                alert("Please enter a subject name.");
                return;
            }
            const createdSubject = adminDashService.createSubject(this.newSubject.subject_name);
            this.subjects.push(createdSubject);
            this.newSubject.subject_name = '';
        },
        deleteSubject(subjectId) {
            if (!confirm("Are you sure you want to delete this subject?")) {
                return;
            }
            adminDashService.deleteSubject(subjectId);
            this.subjects = this.subjects.filter(subject => subject.id !== subjectId);
        },
    }
};
</script>

<!-- <script>
import adminDashboardService from './services/adminDashboardService';

export default {
    name: 'SubjectManagement',
    data() {
        return {
            newSubject: {
                subject_name: '',
            },
            subjects: [], 
        };
    },
    created() {
        this.fetchSubjects();
    },
    methods: {
        createSubject() {
            if (!this.newSubject.subject_name.trim()) {
                alert("Please enter a subject name.");
                return;
            }
            adminDashboardService.createSubject({ subject_name: this.newSubject.subject_name })
                .then(() => {
                    alert("Subject added successfully!");
                    this.newSubject.subject_name = '';
                    this.fetchSubjects();
                })
                .catch(error => {
                    alert("Error adding subject: " + error.message);
                    console.error(error.response);
                });
        },
        fetchSubjects() {
            adminDashboardService.getSubjects()
                .then(response => {
                    this.subjects = response.data;
                })
                .catch(error => {
                    console.error("Error fetching subjects:", error.response);
                });
        },

        deleteSubject(subjectId) {
            if (!confirm("Are you sure you want to delete this subject?")) {
                return;
            }

            adminDashboardService.deleteSubject(subjectId)
                .then(() => {
                    alert("Subject deleted successfully!");
                    this.fetchSubjects();
                })
                .catch(error => {
                    alert("Error deleting subject: " + error.message);
                    console.error(error.response);
                });
        },
    },
};
</script> -->

<style>
.subject-management {
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.form-container {
    margin-bottom: 20px;
}

.subject-form {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 20px;
}

.form-field {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: calc(100% - 100px);
}

.submit-button {
    padding: 10px 20px;
    margin-left: 10px;
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

.table-container {
    overflow-x: auto;
}

.subjects-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

.subjects-table th,
.subjects-table td {
    padding: 10px;
    border: 1px solid #ddd;
}

.subjects-table th {
    background-color: #009688;
    color: white;
}

.delete-button {
    padding: 5px 10px;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.delete-button:hover {
    background-color: #dc2836;
}
</style>
