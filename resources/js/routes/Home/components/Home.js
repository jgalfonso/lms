import React, { Component }  from "react";
import {connect} from 'react-redux';
import { withSnackbar } from 'notistack';

import { getByID } from "../../../helpers/students";
import { isNotEmpty } from "../../../helpers/lib";
import snackBar from '../../../helpers/snackbar';
import history from '../../../utils/history';

class Home extends Component {
	constructor(){
        super();

        this.state = {
            dt: [],
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

        let dt = await getByID(this.state.user.access_token);

        this.setState({ dt })
    }
    

	render() {
        const { dt } = this.state;

		return (
        	<div id="main-content">
                <div className="container-fluid">
                    <div className="block-header">
                        <div className="row clearfix">
                            <div className="col-md-6 col-sm-12">
                                <h2>Home</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                    <li className="breadcrumb-item"><a href="/">Home</a></li>
                                    <li className="breadcrumb-item active" aria-current="page">{isNotEmpty(dt) && dt.first_name +' '+ dt.last_name}</li>
                                    </ol>
                                </nav>
                            </div>     
                        </div>
                    </div>

                    <div className="row clearfix">
                        <div className="col-md-12">
                            <div className="card">
                                <div className="profile-header d-flex justify-content-between justify-content-center" style={{ color: "#fff", padding: "20px", position: "relative", overflow: "hidden", borderRadius: ".1875rem", boxShadow: "inset 0 0 0 2000px #51c3d7" }} >
                                    {
                                        isNotEmpty(dt) && (
                                                <>
                                                    <div className="d-flex">
                                                        <div className="mr-3">
                                                            <img src={dt.attachment_path+dt.attachment_filename} class="rounded" alt="" style={{ height: "140px" }} />
                                                        </div>

                                                        <div className="details">
                                                            <h5 className="mb-0">{dt.first_name +' '+ dt.last_name}</h5>
                                                            <span className="text-light">{dt.course}</span>
                                                            <p className="mb-0"><span>Posts: <strong>321</strong></span> <span>Followers: <strong>4,230</strong></span> <span>Following: <strong>560</strong></span></p>
                                                        </div>                                
                                                    </div>

                                                    <div>
                                                        <button className="btn btn-default btn-sm" style={{ width: "100px" }}>Message</button>
                                                    </div>
                                                </>
                                            ) 
                                    }
                                </div>
                            </div>
                        </div>

                        <div className="col-md-8">
                             <ul className="nav nav-tabs3">
                                <li className="nav-item"><a className="nav-link active show" data-toggle="tab" href="#Feed">Feeds</a></li>
                                <li className="nav-item"><a className="nav-link" data-toggle="tab" href="#Activity">Activity</a></li>
                                <li className="nav-item"><a className="nav-link" data-toggle="tab" href="#Friends">Friends</a></li>
                            </ul>

                            <div className="row clearfix">
                                <div className="tab-content col-md-12">
                                    <div className="tab-pane vivify fadeIn delay-100 active show" id="Feed">
                                        <div className="card"  style={{ marginBottom: "15px" }}>
                                            {
                                                isNotEmpty(dt) && (
                                                    <div className="body">
                                                        <div className="d-flex mb-3">
                                                            <div className="icon bg-transparent">
                                                                <img src="assets/images/user.png" className="rounded mr-3 w40" alt="" />
                                                            </div>
                                                            <div>
                                                                <h6 className="mb-0">{dt && dt.course}</h6>
                                                                <span>{dt.first_name +' '+ dt.last_name}</span>
                                                            </div>
                                                        </div>
                                                        <div className="form-group">
                                                            <textarea rows="4" className="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                                        </div>
                                                        <div className="align-right">
                                                            <button className="btn btn-primary" style={{ width: "100px" }} >Post</button>
                                                        </div>
                                                    </div>
                                                )
                                            }
                                           
                                        </div>
                                    </div>

                                    <div className="tab-pane vivify fadeIn delay-100 active show" id="Activity">
                                    </div>
                                </div>
                            </div>
                        </div>    

                        <div className="col-md-4">
                             <div className="card" style={{ marginBottom: "15px" }} >
                                <div className="body">
                                    <div className="card-value float-right text-warning" style={{ height: "auto" }}><i className="fa fa-bullhorn"></i></div>
                                    <h5 style={{ marginBottom: "30px" }}>Announcements</h5>

                                    <ul class="list-group" style={{ width: "100%" }}>
                                        <li class="list-group-item">
                                            <h5 class="text-muted">To: All Students - email NEW Format</h5>
                                            <small>a minute ago</small>
                                            <br/>
                                             <br/>
                                            <p class="mb-0">Please be informed that we will be adopting a new format for the email addresses of students, as follows:</p>
                                            <br/>
                                            <p class="mb-0">URL: gmail.com</p>
                                            <br/>
                                            <p class="mb-0">Email address: firstname.lastname@dhvsu.edu.ph</p>
                                            <br/>
                                            <p class="mb-0">Initial password: student number (including hyphens, if any)</p>
                                            <br/>
                                            <p class="mb-0">NOTE: for those with student numbers with less than 8 digits, -dhvsu will be appended, thus</p>
                                        </li>
                                    </ul>
                                </div>
                             </div>

                             <div className="card">
                                <div className="body">
                                    <div className="card-value float-right text-warning" style={{ height: "auto" }}><i className="fa fa-calendar"></i></div>
                                    <h5 style={{ marginBottom: "30px" }}>Upcomming Events</h5>
                                    <br/>
                                    <p>No upcomming events...</p>
                                </div>
                             </div>
                        </div>
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

export default connect(mapStateToProps)(withSnackbar(Home));