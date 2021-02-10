import React, { Component }  from "react";
import {connect} from 'react-redux';

import { getLessonByID } from "../../../../../helpers/classes";
import { isNotEmpty } from "../../../../../helpers/lib";

import Sidebar from '../../../Sidebar/Menu';
import Content from '../containers/Content';
import Attachments from '../containers/Attachments';

class Main extends Component {
	constructor(){
        super();

        this.state = {
            classID: '',
            lessonID: '',
            dt: [],
            user: []
        } 
    }

    static getDerivedStateFromProps(props, state) {
        
        return{...state, user: JSON.parse(props.user)}
    } 

   	async componentDidMount() {
        
        let classID = this.props.match.params.class_id;
        let lessonID = this.props.match.params.lesson_id;

        let dt = await getLessonByID(lessonID, this.state.user.access_token);

        this.setState({ classID, lessonID, dt });
    }

	render() {
        const { classID, dt } = this.state;

        return (
            <div id="main-content">
                <div className="container-fluid">
                    <div className="block-header">
                        <div className="row clearfix">
                            <div className="col-md-6 col-sm-12">
                                <h2>{ dt.overview && dt.overview.lesson_title || <span class="loading">Loading 1. title</span> }</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="/">Home</a></li>
                                        <li className="breadcrumb-item">Classes</li>
                                        <li className="breadcrumb-item"><a href={'/classes/'+classID+'/lessons'}>Lessons</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">{ dt.overview && dt.overview.lesson_code || <span class="loading">2. code</span> }</li>
                                    </ol>
                                </nav>
                            </div>   

                            <div className="col-md-6 col-sm-12 text-right hidden-xs">
                                <a href={dt.overview && dt.overview.class_link} className="btn btn-sm btn-primary" title="" target="_blank" style={{ marginRight: "3px" }}><i className="fa fa-wechat"></i> Virtual Classroom</a>
                                <a href="/calendar" className="btn btn-sm btn-success" title=""><i className="fa fa-calendar"></i> Course Calendar</a>
                            </div>  
                        </div>
                    </div>

                    <div className="row clearfix">
                        <Sidebar classID={classID} />

                        {
                            isNotEmpty(dt.overview) && (

                                <div className="col-md-10">
                                    <div className="row clearfix">
                                        
                                        <Content data={dt} />

                                        {
                                            isNotEmpty(dt.attachments) && <Attachments data={dt} />
                                        }
                                    </div>
                                </div>

                            ) || <p class="loading">& 3. content, please wait</p>
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
