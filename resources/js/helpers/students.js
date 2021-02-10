import axios from 'axios';

export const getByID = (token) => {
    return axios.get('/api/students/get-byid', {
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