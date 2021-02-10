import React, { Component }  from "react";
import {connect} from 'react-redux';

import { getAnnouncementByID } from "../../../../../helpers/announcements";
import { getByReferenceID } from "../../../../../helpers/comments";
import { isNotEmpty } from "../../../../../helpers/lib";

import Sidebar from '../../../Sidebar/Menu';
import Content from '../containers/Content';
import Comments from '../containers/Comments';

class View extends Component {
	constructor(){
        super();

        this.state = {
            classID: '',
            announcementID: '',
            row: [],
            dt: [],
            user: []
        } 
    }

    static getDerivedStateFromProps(props, state) {
        
        return{...state, user: JSON.parse(props.user)}
    } 

   	async componentDidMount() {
        
        let classID = this.props.match.params.class_id;
        let announcementID = this.props.match.params.announcement_id;

        let dt = await getAnnouncementByID(announcementID, this.state.user.access_token);

        this.setState({ classID, announcementID, row: dt.announcement, dt: dt.comments });
    }

    handleSuccess = async () => {
        let dt = await getByReferenceID(1, this.state.announcementID, this.state.user.access_token);

        this.setState({ dt });
    }

	render() {
        const { classID, row } = this.state;

        return (
            <div id="main-content">
                <div className="container-fluid">
                    <div className="block-header">
                        <div className="row clearfix">
                            <div className="col-md-6 col-sm-12">
                                <h2>{row && row.title}</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="/">Home</a></li>
                                        <li className="breadcrumb-item">Classes</li>
                                        <li className="breadcrumb-item"><a href={'/classes/'+classID+'/announcements'}>Announcements</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">Announcement ID : {row && row.announcement_id}</li>
                                    </ol>
                                </nav>
                            </div>   

                            <div className="col-md-6 col-sm-12 text-right hidden-xs">
                                <a href={row && row.class_link} className="btn btn-sm btn-primary" title="" target="_blank" style={{ marginRight: "3px" }}><i className="fa fa-wechat"></i> Virtual Classroom</a>
                                <a href="/calendar" className="btn btn-sm btn-success" title=""><i className="fa fa-calendar"></i> Course Calendar</a>
                            </div>  
                        </div>
                    </div>

                    <div className="row clearfix">
                        
                        <Sidebar classID={classID} />

                        {
                            isNotEmpty(row) && (

                                    <div className="col-md-10">
                                        <div className="row clearfix">
                                            
                                            <Content data={row} />

                                            <Comments {...this.state} onSuccess={this.handleSuccess} />
                                        </div>
                                    </div>
                               
                            ) || <p class="loading">Loading content, please wait</p>
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

export default connect(mapStateToProps)(View);
