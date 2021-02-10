import React, {Component} from 'react';
import {connect} from 'react-redux';

import { setNavStatus, setSubNavStatus } from "../../helpers/app";
import { getEnrolled } from "../../helpers/classes";

class LeftSideBar extends Component {
    constructor(props){
        super(props);

        this.state = {
            user: []
        }
    }    

    static getDerivedStateFromProps(props, state) {
        return{...state, user: JSON.parse(props.user)}
    }  

    async componentDidMount() {
        
        let dt = await getEnrolled(this.state.user.access_token);

        this.setState({ dt })
    }

	render() {
        const { user, dt } = this.state;

    	return (
            <div id="left-sidebar" className="sidebar">
                <div className="navbar-brand">
                    <a href="/"><img src="/assets/images/logo1.png" alt="Oculux Logo" className="img-fluid logo" /><span style={{ marginLeft: "5px" }}>a<b>LMS</b> DHVSU</span></a>
                    <button type="button" className="btn-toggle-offcanvas btn btn-sm float-right"><i className="lnr lnr-menu icon-close"></i></button>
                </div>

                <div className="sidebar-scroll">
                    <div className="user-account" style={{ textAlign: "center", margin: "20px 10px 0 10px" }} >
                        <div className="user_div">
                            <img src={user.avatar} className="user-photo" alt="User Profile Picture" style={{ width: "70px", marginBottom: "10px" }} />
                        </div>
                        <div className="dropdown">
                            <span>Welcome,</span>
                            <a className="dropdown-toggle user-name" data-toggle="dropdown"><strong>{user.name} </strong></a>

                            <ul className="dropdown-menu dropdown-menu-right account vivify flipInY">
                                <li><a href=""><i className="icon-user"></i>My Profile</a></li>
                                <li><a href=""><i className="icon-envelope-open"></i>Messages</a></li>
                                <li><a href=""><i className="icon-settings"></i>Settings</a></li>
                                <li className="divider"></li>
                                <li><a href=""><i className="icon-power"></i>Logout</a></li>
                            </ul>
                        </div>                
                    </div>  

                    <nav id="left-sidebar-nav" className="sidebar-nav">
                        <ul id="main-menu" className="metismenu">
                            <li className="header">Main</li>

                            <li className={setNavStatus('/dashboard')}><a href="/dashboard"><i className="icon-speedometer"></i><span>Dashboard</span></a></li>

                            <li className={setNavStatus('/')}><a href="/"><i className="icon-home"></i><span>Home</span></a></li>

                            <li className={setNavStatus(['/classes/join', '/classes/:class_id/overview', '/classes/:class_id/announcements', '/classes/:class_id/announcements/:announcement_id', '/classes/:class_id/lessons', '/classes/:class_id/lessons/:lesson_id', '/classes/:class_id/attendance', '/classes/:class_id/assignments', '/classes/:class_id/assignments/:assignment_id', '/classes/:class_id/projects', '/classes/:class_id/projects/:project_id', '/classes/:class_id/quizzes', '/classes/:class_id/quizzes/:quiz_id', '/classes/:class_id/quizzes/:quiz_id/result', '/classes/:class_id/exams', '/classes/:class_id/exams/:exam_id', '/classes/:class_id/grades', '/classes/:class_id/participants'])}>
                                <a href="" className="has-arrow" ><i className="icon-docs"></i><span>Classes</span></a>

                                <ul className={setSubNavStatus(['/classes/join', '/classes/:class_id/overview', '/classes/:class_id/announcements', '/classes/:class_id/announcements/:announcement_id', '/classes/:class_id/lessons',  '/classes/:class_id/lessons/:lesson_id', '/classes/:class_id/attendance', '/classes/:class_id/assignments', '/classes/:class_id/assignments/:assignment_id', '/classes/:class_id/projects', '/classes/:class_id/projects/:project_id', '/classes/:class_id/quizzes', '/classes/:class_id/quizzes/:quiz_id', '/classes/:class_id/quizzes/:quiz_id/result', '/classes/:class_id/exams', '/classes/:class_id/exams/:exam_id', '/classes/:class_id/grades', '/classes/:class_id/participants'])}>
                                    <li className={setNavStatus('/classes/join')}><a  href="/classes/join">Join Class</a></li>

                                    {
                                        dt && dt.map((data, index) => {
            
                                            return (

                                               <li key={index} className={setNavStatus(['/classes/'+data.class_id+'/overview', '/classes/'+data.class_id+'/announcements', '/classes/'+data.class_id+'/announcements/:announcement_id', '/classes/'+data.class_id+'/lessons',  '/classes/'+data.class_id+'/lessons/:lesson_id', '/classes/'+data.class_id+'/attendance', '/classes/'+data.class_id+'/assignments', '/classes/'+data.class_id+'/assignments/:assignment_id', '/classes/'+data.class_id+'/projects', '/classes/'+data.class_id+'/projects/:project_id', '/classes/'+data.class_id+'/quizzes', '/classes/'+data.class_id+'/quizzes/:quiz_id', '/classes/'+data.class_id+'/quizzes/:quiz_id/result', '/classes/'+data.class_id+'/exams', '/classes/'+data.class_id+'/exams/:exam_id', '/classes/'+data.class_id+'/grades', '/classes/'+data.class_id+'/participants'])}><a  href={'/classes/'+data.class_id+'/overview'}>{data.class_name}</a></li>
                                            )
                                        })
                                    }
                                </ul>
                            </li>

                            <li><a href=""><i className="icon-users"></i><span>Groups</span></a></li>

                            <li className={setNavStatus('/calendar')}><a href="/calendar"><i className="icon-calendar"></i><span>Calendar</span></a></li>

                            <li className={setNavStatus('/forums')}><a href="/forums"><i className="icon-bubbles"></i><span>Forum</span></a></li>


                            <li style={{ display: 'none' }} className="header">Utilities</li>

                            <li style={{ display: 'none' }} ><a href=""><i className="icon-doc"></i><span>Documentation</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return { 
       user: state.auth.user
    }
}

export default connect(mapStateToProps)(LeftSideBar);