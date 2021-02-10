import React, { Component }  from "react";
import {connect} from 'react-redux';

import { getAnnouncements } from "../../../../../helpers/classes";
import { isNotEmpty } from "../../../../../helpers/lib";

import Sidebar from '../../../Sidebar/Menu';
import List from '../containers/List';

class Main extends Component {
	constructor(){
        super();

        this.state = {
            classID: '',
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

        let dt = await getAnnouncements(1, classID, this.state.user.access_token);

        this.setState({ classID, row: dt.overview, dt: dt.announcements });
    }

	render() {
        const { classID, row, dt } = this.state;

        return (
            <div id="main-content">
                <div className="container-fluid">
                    <div className="block-header">
                        <div className="row clearfix">
                            <div className="col-md-6 col-sm-12">
                                <h2>Announcements</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="/">Home</a></li>
                                        <li className="breadcrumb-item">Classes</li>
                                        <li className="breadcrumb-item active" aria-current="page">Announcements</li>
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
                            isNotEmpty(dt) && <List {...this.state} /> || <p class="loading">Loading content, please wait</p>
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
