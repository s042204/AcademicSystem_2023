import http from "./http.js";

const createGroup = (groupData) => {
    return http.post("/groups", { group_name: groupData.name });
};

const getGroups = () => {
    return http.get("/groups");
};

const deleteGroup = (groupId) => {
    return http.delete(`/groups/${groupId}`);
};

const createStudent = (studentData) => {
    const payload = {
        username: studentData.name.toLowerCase(),
        password: studentData.surname.toLowerCase(),
        name: studentData.name,
        surname: studentData.surname,
        role: "student",
    };
    return http.post("/users", payload);
};

const getStudents = () => {
    return http.get("/users");
};

const deleteStudent = (studentId) => {
    return http.delete(`/users/${studentId}`);
};

const createSubject = (subjectData) => {
    return http.post("/subjects", subjectData);
};

const getSubjects = () => {
    return http.get("/subjects");
};

const deleteSubject = (subjectId) => {
    return http.delete(`/subjects/${subjectId}`);
};

const updateStudentGroup = (studentId, groupId) => {
    return http.put(`/users/${studentId}`, { group_id: groupId });
};

const createTeacher = (teacherData) => {
    const payload = {
        username: teacherData.name.toLowerCase(),
        password: teacherData.surname.toLowerCase(),
        name: teacherData.name,
        surname: teacherData.surname,
        role: "teacher",
    };
    return http.post("/users", payload);
};

const getTeachers = () => {
    return http.get("/users");
};

const deleteTeacher = (teacherId) => {
    return http.delete(`/users/${teacherId}`);
};

const updateTeacherGroup = (teacherId, groupId) => {
    return http.put(`/users/${teacherId}`, { group_id: groupId });
};

const updateTeacherSubject = (teacherId, subjectId) => {
    return http.put(`/users/${teacherId}`, { subject_id: subjectId });
};

const addGroupToTeacher = (teacherId, groupId) => {
    return http.put(`/users/${teacherId}`, { group_id: groupId });
};

const removeGroupFromTeacher = (teacherId, groupId) => {
    return http.delete(`/users/${teacherId}/groups/${groupId}`);
};

const deleteSubjectFromTeacher = (teacherId) => {
    return http.put(`/users/${teacherId}`, { subject_id: null });
};

const assignSubjectToTeacher = (teacherId, subjectId) => {
    return http.put(`/users/${teacherId}`, { subject_id: subjectId });
}

export default {
    createGroup,
    getGroups,
    deleteGroup,
    updateStudentGroup,
    createStudent,
    getStudents,
    deleteStudent,
    updateTeacherGroup,
    createTeacher,
    getTeachers,
    deleteTeacher,
    createSubject,
    getSubjects,
    deleteSubject,
    updateTeacherSubject,
    addGroupToTeacher,
    removeGroupFromTeacher,
    deleteSubjectFromTeacher,
    assignSubjectToTeacher,
};
