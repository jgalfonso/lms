export const isNotEmpty = (obj) => {
    for(var key in obj) {
        if(obj.hasOwnProperty(key)) return true;
    }

    return false;
}

export const getIP = ()=>{
	return fetch("https://api.ipify.org?format=json")
	  .then(response => response.json())
	  .then(res => {
	  		console.log(res.ip)
	  		return res.ip
	  })
	  .catch(err => console.log(err))
}

export const ucfirst = (string) => {
	return string.charAt(0).toUpperCase() + string.slice(1);
}
