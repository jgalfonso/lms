import axios from 'axios';

export const getAnnouncementByID = (announcementID, token) => {
    return axios.get('/api/announcements/get-announcements-byid', {
        params : {  
            announcementID : announcementID
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