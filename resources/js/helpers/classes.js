import axios from 'axios';

export const getEnrolled = (token) => {
    return axios.get('/api/classes/get-enrolled', {
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getClass = (token) => {
    return axios.get('/api/classes/get-class', {
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getClassForApproval = (token) => {
    return axios.get('/api/classes/get-class-forapproval', {
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getOverview = (classID, token) => {
    return axios.get('/api/classes/get-overview', {
        params : {  
            classID : classID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getAnnouncements = (announcementTypeID, referenceID, token) => {
    return axios.get('/api/classes/get-announcements', {
        params : {  
            announcementTypeID: announcementTypeID,
            referenceID : referenceID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}








export const getLessons = (classID, token) => {
    return axios.get('/api/classes/get-lessons', {
        params : {  
            classID : classID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getLessonByID = (lessonID, token) => {
    return axios.get('/api/classes/get-lesson-byid', {
        params : {  
            lessonID : lessonID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getAttendance = (classID, token) => {
    return axios.get('/api/classes/get-attendance', {
        params : {  
            classID : classID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getAssignments = (classID, token) => {
    return axios.get('/api/classes/get-assignments', {
        params : {  
            classID : classID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getAssignmentByID = (assignmentID, token) => {
    return axios.get('/api/classes/get-assignment-byid', {
        params : {  
            assignmentID : assignmentID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getSubmittedAssignment = (assignmentID, token) => {
    return axios.get('/api/classes/get-submitted_assignment-byid', {
        params : {  
            assignmentID : assignmentID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getProjects = (classID, token) => {
    return axios.get('/api/classes/get-projects', {
        params : {  
            classID : classID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getProjectByID = (projectID, token) => {
    return axios.get('/api/classes/get-project-byid', {
        params : {  
            projectID : projectID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getSubmittedProject = (projectID, token) => {
    return axios.get('/api/classes/get-submitted_project-byid', {
        params : {  
            projectID : projectID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getQuizzes = (classID, token) => {
    return axios.get('/api/classes/get-quizzes', {
        params : {  
            classID : classID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getQuizByID = (quizID, token) => {
    return axios.get('/api/classes/get-quiz-byid', {
        params : {  
            quizID : quizID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getQuizChoicesByID = (quizDetailID, token) => {
    return axios.get('/api/classes/get-quizchoices-byid', {
        params : {  
            quizDetailID : quizDetailID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getQuizResultByID = (quizID, quizParticipantID, token) => {
    return axios.get('/api/classes/get-quizresult-byid', {
        params : {  
            quizID : quizID,
            quizParticipantID : quizParticipantID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getExams = (classID, token) => {
    return axios.get('/api/classes/get-exams', {
        params : {  
            classID : classID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getExamByID = (examID, token) => {
    return axios.get('/api/classes/get-exam-byid', {
        params : {  
            examID : examID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const getParticipants = (classID, token) => {
    return axios.get('/api/classes/get-participants', {
        params : {  
            classID : classID
        },
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });  
}

export const joinClass = (data, token) => {
    return axios.post('/api/classes/join', data, {
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });    
}

export const attachAssignment = (data, token) => {
    return axios.post('/api/classes/attach-assignment', data, {
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });    
}

export const attachProject = (data, token) => {
    return axios.post('/api/classes/attach-project', data, {
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });    
}

export const takeQuiz = (data, token) => {
    return axios.post('/api/classes/take-quiz', data, {
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });    
}

export const answerQuiz = (data, token) => {
    return axios.post('/api/classes/answer-quiz', data, {
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });    
}

export const submitQuiz = (data, token) => {
    return axios.post('/api/classes/submit-quiz', data, {
        headers : {
            'Authorization' : 'Bearer '+ token
        }
    })
    .then(response => {
        return response.data
    })
    .catch(error => {
        console.log(error);
    });    
}
