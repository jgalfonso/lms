import React, { Component }  from "react";
import {connect} from 'react-redux';

import { getClass, getClassForApproval } from "../../../../helpers/classes";

import Form from '../containers/Form';
import List from '../containers/List';

class Join extends Component {
	constructor(){
        super();

        this.state = {
            dt1: [],
            dt2: [],
            user: []
        } 
    }

    static getDerivedStateFromProps(props, state) {
        
        return{...state, user: JSON.parse(props.user)}
    } 

   	async componentDidMount() {
        
        let dt = await getClass(this.state.user.access_token);

        dt && this.setState({ dt1: dt.approved, dt2: dt.pending });
    }

    handleSuccess = async () => {

        let dt2 = await getClassForApproval(this.state.user.access_token);

        this.setState({ dt2 })
    }

	render() {
        return (
            <div id="main-content">
                <div className="container-fluid">
                    <div className="block-header">
                        <div className="row clearfix">
                            <div className="col-md-6 col-sm-12">
                                <h2>Join Class</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="/">Home</a></li>
                                        <li className="breadcrumb-item">Classes</li>
                                        <li className="breadcrumb-item active" aria-current="page">Join Class</li>
                                    </ol>
                                </nav>
                            </div>     
                        </div>
                    </div>

                    <div className="row clearfix">
                        <Form {...this.state} onSuccess={this.handleSuccess} />

                        <List {...this.state} />
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

export default connect(mapStateToProps)(Join);
