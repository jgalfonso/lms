import axios from 'axios';

export const signIn = (data) => {
	return axios.post('/api/auth/sign-in', data)
    	.then(response => {

        	return response.data;
    	})
   	 	.catch(error => {
        	console.log(error);

        	return error.response.data
    	});    
}

export const signOut = () => {
    return axios.post('/api/auth/sign-out')
    .then(response => {

        return response.data;
    })
    .catch(error => {
        console.log(error);

        return error.response.data
    });    
}