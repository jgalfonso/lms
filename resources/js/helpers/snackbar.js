import React from "react";

const snackBar = {
    show: function(props, message, variant) {
    	const action = (key) => (
       		 <a onClick={() => { props.closeSnackbar(key) }} style={{ color: '#000', fontSize: '14px', marginRight: '10px' }} >DISMISS</a>

     	);

    	props.enqueueSnackbar(message, { variant, autoHideDuration: 5000, action });
    }
}

export default snackBar;

