import React, { Component }  from "react";
import {connect} from 'react-redux';
import { withSnackbar } from 'notistack';

import snackBar from '../../../helpers/snackbar';
import history from '../../../utils/history';

class Wiki extends Component {
	constructor(){
        super();

        this.state = {
            user: []
        } 
    }

    static getDerivedStateFromProps(props, state) {
        
        return{...state, user: JSON.parse(props.user)}
    } 


   	async componentDidMount() {
		const { location, history } = this.props;

        location.state !== undefined && (
            setTimeout(() => {

            	location.state.success && snackBar.show(this.props, location.state.message, location.state.variant);
                history.replace();
            }, 1500)
        ) 
    }
    

	render() {
        const { dt } = this.state;

		return (
        	<div id="main-content">
                <div className="container-fluid">
                    <div className="block-header">
                        <div className="row clearfix">
                            <div className="col-md-6 col-sm-12">
                                <h2>Wiki</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                    <li className="breadcrumb-item"><a href="/">Home</a></li>
                                    <li className="breadcrumb-item active" aria-current="page">Wiki</li>
                                    </ol>
                                </nav>
                            </div>     
                        </div>
                    </div>

                    <div className="row clearfix">
                     
                    </div>
                </div>
            </div>
        )
    }
}

function mapStateToProps(state) {
    return { 
       user: state.auth.user
    }
}

export default connect(mapStateToProps)(withSnackbar(Wiki));