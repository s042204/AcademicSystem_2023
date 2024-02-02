<template>
    <div class="teacher-management">
        <h2>Teacher Management</h2>
        <form @submit.prevent="createTeacher" class="teacher-form">
            <input type="text" v-model="newTeacher.name" placeholder="Teacher's Name" class="input-field">
            <input type="text" v-model="newTeacher.surname" placeholder="Teacher's Surname" class="input-field">
            <button type="submit" class="submit-btn">Create Teacher</button>
        </form>

        <table class="teacher-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Groups</th>
                    <th>Subject</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="teacher in teachers" :key="teacher.id">
                    <td>{{ teacher.name }}</td>
                    <td>{{ teacher.surname }}</td>
                    <td>
                        {{ getTeacherGroups(teacher) }}
                        <select v-model="selectedGroup" @change="updateTeachersGroup(teacher)">
                            <option disabled value="">Add Group</option>
                            <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.group_name }}
                            </option>
                        </select>
                    </td>
                    <td>
                        {{ getSubjectName(teacher.subject_id) }}
                        <select v-model="teacher.subject_id" @change="assignSubjectToTeacher(teacher)">
                            <option disabled value="">Select Subject</option>
                            <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{
                                subject.subject_name }}</option>
                        </select>
                    </td>
                    <td>
                        <button @click="deleteTeacher(teacher.id)" class="delete-btn">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import adminDashService from './services/adminDashService';

export default {
    name: 'TeacherManagement',
    data() {
        return {
            newTeacher: {
                id: null,
                name: '',
                surname: '',
                groups: [],
                subject_id: null,
            },
            teachers: [],
            groups: [],
            subjects: [],
        };
    },
    mounted() {
        this.loadTeachers();
        this.loadGroups();
        this.loadSubjects();
    },
    methods: {
        loadTeachers() {
            this.teachers = adminDashService.loadTeachers();
        },
        loadGroups() {
            this.groups = adminDashService.loadGroups();
        },
        loadSubjects() {
            this.subjects = adminDashService.loadSubjects();
        },
        createTeacher() {
            if (!this.newTeacher.name || !this.newTeacher.surname) {
                alert("Please enter both name and surname.");
                return;
            }
            const createdTeacher = adminDashService.createTeacher(this.newTeacher);
            this.teachers.push(createdTeacher);
            this.newTeacher.name = '';
            this.newTeacher.surname = '';
            this.newTeacher.groups = [];
            this.newTeacher.subject_id = null;
        },
        saveTeachers() {
            adminDashService.saveTeachers(this.teachers);
        },
        deleteTeacher(teacherId) {
            if (!confirm("Are you sure you want to delete this teacher?")) {
                return;
            }
            adminDashService.deleteTeacher(teacherId);
            this.loadTeachers(); 
        },
        updateTeachersGroup(teacher, groupId) {
            const groupIds = teacher.groups.includes(groupId) 
                ? teacher.groups.filter(id => id !== groupId)
                : [...teacher.groups, groupId];
            adminDashService.updateTeachersGroups(teacher.id, groupId);
            this.loadTeachers();
        },
        assignSubjectToTeacher(teacherId, subjectId) {
            adminDashService.assignSubjectToTeacher(teacherId, subjectId);
            const updatedTeacher = this.teachers.find(t => t.id === teacherId);
            if (updatedTeacher) updatedTeacher.subject_id = subjectId;
        },
        getSubjectName(subjectId) {
            const subject = this.subjects.find(subject => subject.id === subjectId);
            return subject ? subject.subject_name : 'Not assigned';
        },
        getTeacherGroups(teacher) {
            const loadGroups = adminDashService.loadGroups();
            return teacher.groups.map(groupId => {
                const group = this.groups.find(group => group.id === groupId);
                return group ? group.group_name : 'Unknown Group';
            }).join(', ');
        },
    }
};
</script>



<style scoped>
.teacher-management {
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.teacher-form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.input-field {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    flex-grow: 1;
}

.submit-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.submit-btn:hover {
    background-color: #45a049;
}

.teacher-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.teacher-table th,
.teacher-table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

.teacher-table th {
    background-color: #009688;
    color: white;
}

.group-list {
    display: flex;
    align-items: center;
    gap: 5px;
}

.remove-btn,
.delete-btn {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.remove-btn {
    background-color: #f44336;
    color: white;
}

.remove-btn:hover {
    background-color: #d32f2f;
}

.delete-btn {
    background-color: #f44336;
    color: white;
}

.delete-btn:hover {
    background-color: #d32f2f;
}
</style>
