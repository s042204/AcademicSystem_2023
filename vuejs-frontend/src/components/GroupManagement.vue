<template>
    <div class="group-management">
        <h2>Group Management</h2>
        <form @submit.prevent="createGroup">
            <input type="text" v-model="newGroup.group_name" placeholder="Enter group name">
            <button type="submit">Create</button>
        </form>
        <ul>
            <li v-for="group in groups" :key="group.id">
                <label>
                    <input type="radio" name="selectedGroup" :value="group.id" v-model="selectedGroupId">
                    {{ group.group_name }}
                </label>
                <button class="delete-btn" @click="deleteGroup(group.id)">Delete</button>
            </li>
        </ul>
        <!-- <button class="delete-btn" @click="deleteSelectedGroup">Delete Selected Group</button> -->
    </div>
</template>


<script>
import adminDashService from "./services/adminDashService";

export default {
    name: 'GroupManagement',
    data() {
        return {
            newGroup: {
                group_name: ''
            },
            groups: [],
            selectedGroupId: null
        };
    },
    mounted() {
        this.groups = adminDashService.loadGroups();
    },
    methods: {
        createGroup() {
            if (!this.newGroup.group_name) {
                alert("Please enter a group name.");
                return;
            }
            const createdGroup = adminDashService.createGroup(this.newGroup.group_name);
            this.groups.push(createdGroup);
            this.newGroup.group_name = '';
        },
        deleteGroup(groupId) {
            adminDashService.deleteGroup(groupId);
            this.groups = this.groups.filter(group => group.id !== groupId);
        },
        deleteSelectedGroup() {
            if (!this.selectedGroupId) {
                alert("Please select a group to delete.");
                return;
            }
            this.deleteGroup(this.selectedGroupId);
            this.selectedGroupId = null;
        }
    }
};
</script>

<!-- <script>
import adminDashboardService from '../components/services/adminDashboardService.js';

export default {
    name: 'GroupManagement',
    data() {
        return {
            newGroup: {
                group_name: ''
            },
            groups: [],
            selectedGroupId: null
        };
    },
    created() {
        this.fetchGroups();
    },
    methods: {
        fetchGroups() {
            adminDashboardService.getGroups()
                .then(response => {
                    this.groups = response.data;
                })
                .catch(error => {
                    console.error("Error fetching groups:", error.response);
                });
        },
        createGroup() {
            if (this.newGroup.group_name.trim() === '') {
                alert("Please enter a group name.");
                return;
            }

            const groupData = {
                name: this.newGroup.group_name
            };

            adminDashboardService.createGroup(groupData)
                .then(() => {
                    alert("Group created successfully!");
                    this.newGroup.group_name = '';
                    this.fetchGroups();
                })
                .catch(error => {
                    alert("Error creating group: " + error.message);
                    console.error(error.response);
                });
        },
        deleteGroup(groupId) {
            adminDashboardService.deleteGroup(groupId)
                .then(() => {
                    alert("Group deleted successfully!");
                    this.fetchGroups();
                })
                .catch(error => {
                    alert("Error deleting group: " + error.message);
                    console.error(error.response);
                });
        },
        deleteSelectedGroup() {
            if (!this.selectedGroupId) {
                alert("Please select a group to delete.");
                return;
            }
            this.deleteGroup(this.selectedGroupId);
        },
    }
};
</script> -->




<style scoped>
.group-management {
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.group-management h2 {
    margin-bottom: 10px;
}

.group-management form {
    margin-bottom: 10px;
}

.group-management input[type="text"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.group-management button[type="submit"] {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.group-management button[type="submit"]:hover {
    background-color: #45a049;
}

.group-management ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.group-management li {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
}

.group-management label {
    margin-right: 10px;
}

.group-management input[type="radio"] {
    margin-right: 5px;
}

.group-management button {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.group-management button.delete-btn {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    background-color: #f44336;
    color: white;
    cursor: pointer;
}

.group-management button.delete-btn:hover {
    background-color: #d32f2f;
}

</style>
