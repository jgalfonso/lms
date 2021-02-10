import axios from 'axios';

export const getByReferenceID = (commentableTypeID, referenceID, token) => {
    return axios.get('/api/comments/get-comments-byreferenceid', {
        params : {  
            commentableTypeID: commentableTypeID,
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

export const add = (data, token) => {
    return axios.post('/api/comments/add', data, {
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

export const del = (data, token) => {
    return axios.post('/api/comments/delete', data, {
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
