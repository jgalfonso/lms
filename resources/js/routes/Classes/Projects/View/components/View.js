import React, { Component }  from "react";
import {connect} from 'react-redux';

import { getProjectByID, getSubmittedProject } from "../../../../../helpers/classes";

import Sidebar from '../../../Sidebar/Menu';
import Content from '../containers/Content';
import Attachments from '../containers/Attachments';
import Form from '../containers/Form';
import Submitted from '../containers/Submitted';

class Main extends Component {
	constructor(){
        super();

        this.state = {
            classID: '',
            projectID: '',
            dt: [],
            submitted: [],
            showModal: false,
            user: []
        } 
    }

    static getDerivedStateFromProps(props, state) {
        
        return{...state, user: JSON.parse(props.user)}
    } 

   	async componentDidMount() {
        
        let classID = this.props.match.params.class_id;
        let projectID = this.props.match.params.project_id;

        let dt = await getProjectByID(projectID, this.state.user.access_token);
        let submitted = await getSubmittedProject(projectID, this.state.user.access_token);

        this.setState({ classID, projectID, dt, submitted });
    }

    handleForm = show => {
        this.setState({ showModal: show });
    }

    handleSuccess = async () => {
        
        const { projectID } = this.state;

        let submitted = await getSubmittedProject(projectID, this.state.user.access_token);
        this.setState({ submitted });
    }

	render() {
        const { classID, dt, submitted, showModal, user } = this.state;

        return (
            <div id="main-content">
                <div className="container-fluid">
                    <div className="block-header">
                        <div className="row clearfix">
                            <div className="col-md-6 col-sm-12">
                                <h2>{dt.overview && dt.overview.project_title}</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="/">Home</a></li>
                                        <li className="breadcrumb-item">Classes</li>
                                        <li className="breadcrumb-item"><a href={'/classes/'+classID+'/projects'}>Projects</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">Project Code : {dt.overview && dt.overview.project_code}</li>
                                    </ol>
                                </nav>
                            </div>   

                            <div className="col-md-6 col-sm-12 text-right hidden-xs">
                                <a onClick={() => this.handleForm(true)} className="btn btn-sm btn-primary" title="" style={{ marginRight: "3px", color: "#fff" }}><i className="fa fa-save"></i> Submit Project</a>
                            </div>  
                        </div>
                    </div>

                    <div className="row clearfix">
                        {
                            dt.overview && (
                                <>
                                    <Sidebar classID={classID} />

                                    <div className="col-md-10">
                                        <div className="row clearfix">
                                            
                                            <Content data={dt} />

                                            {
                                                dt.attachments && <Attachments data={dt} />
                                            }

                                            {
                                                submitted && <Submitted data={submitted} />
                                            }
                                        </div>
                                    </div>

                                    <Form data={dt.overview} show={showModal} onSuccess={this.handleSuccess} onClose={this.handleForm} user={user} />
                                </>
                            )
                        }
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

export default connect(mapStateToProps)(Main);
