const getNewId = (array) => {
    return array.reduce((max, item) => Math.max(max, item.id), 0) + 1;
};

// groups

const saveGroups = (groups) => {
    localStorage.setItem('groups', JSON.stringify(groups));
};

const loadGroups = () => {
    const groups = localStorage.getItem('groups');
    return groups ? JSON.parse(groups) : [];
};

const createGroup = (groupName) => {
    const groups = loadGroups();
    const newGroup = { id: getNewId(groups), group_name: groupName };
    groups.push(newGroup);
    saveGroups(groups);
    return newGroup;
};

const deleteGroup = (groupId) => {
    let groups = loadGroups();
    groups = groups.filter(group => group.id !== groupId);
    saveGroups(groups);
};

// subjects

const loadSubjects = () => {
    const subjects = localStorage.getItem('subjects');
    return subjects ? JSON.parse(subjects) : [];
};

const saveSubjects = (subjects) => {
    localStorage.setItem('subjects', JSON.stringify(subjects));
};

const createSubject = (subjectName) => {
    const subjects = loadSubjects();
    const newSubject = { id: getNewId(subjects), subject_name: subjectName };
    subjects.push(newSubject);
    saveSubjects(subjects);
    return newSubject;
};

const deleteSubject = (subjectId) => {
    let subjects = loadSubjects();
    subjects = subjects.filter(subject => subject.id !== subjectId);
    saveSubjects(subjects);
};

// teachers

const loadTeachers = () => {
    const teachers = localStorage.getItem('teachers');
    return teachers ? JSON.parse(teachers) : [];
};

const saveTeachers = (teachers) => {
    localStorage.setItem('teachers', JSON.stringify(teachers));
};

const createTeacher = (teacherData) => {
    const teachers = loadTeachers();
    const newTeacher = { 
        id: getNewId(teachers), 
        name: teacherData.name, 
        surname: teacherData.surname,
        groups: [], 
        subject_id: null
    };
    teachers.push(newTeacher);
    saveTeachers(teachers);
    return newTeacher;
};

const deleteTeacher = (teacherId) => {
    let teachers = loadTeachers();
    teachers = teachers.filter(teacher => teacher.id !== teacherId);
    saveTeachers(teachers);
};

const assignSubjectToTeacher = (teacherId, subjectId) => {
    let teachers = loadTeachers();
    const teacherIndex = teachers.findIndex(teacher => teacher.id === teacherId);
    if(teacherIndex !== -1) {
        teachers[teacherIndex].subject_id = subjectId;
        saveTeachers(teachers);
    }
};

const updateTeachersGroups = (teacherId, groupId) => {
    let teachers = loadTeachers();
    const teacherIndex = teachers.findIndex(teacher => teacher.id === teacherId);
    if(teacherIndex !== -1) {
        teachers[teacherIndex].groups = groupId;
        saveTeachers(teachers);
    }
};

// students
const loadStudents = () => {
    const students = localStorage.getItem('students');
    return students ? JSON.parse(students) : [];
};

const saveStudents = (students) => {
    localStorage.setItem('students', JSON.stringify(students));
};

const createStudent = (studentData) => {
    const students = loadStudents();
    const newStudent = { 
        id: getNewId(students),
        name: studentData.name, 
        surname: studentData.surname,
        group_id: studentData.group_id || null 
    };
    students.push(newStudent);
    saveStudents(students);
    return newStudent;
};

const deleteStudent = (studentId) => {
    let students = loadStudents();
    students = students.filter(student => student.id !== studentId);
    saveStudents(students);
};

const updateStudentGroup = (studentId, groupId) => {
    let students = loadStudents();
    const studentIndex = students.findIndex(student => student.id === studentId);
    if(studentIndex !== -1) {
        students[studentIndex].group_id = groupId;
        saveStudents(students);
    }
};


export default {
    createGroup,
    loadGroups,
    deleteGroup,
    createSubject,
    loadSubjects,
    deleteSubject,
    getNewId,
    saveGroups,
    createTeacher,
    loadTeachers,
    deleteTeacher,
    assignSubjectToTeacher,
    updateTeachersGroups,
    saveTeachers,
    createStudent,
    loadStudents,
    deleteStudent,
    updateStudentGroup,

};
