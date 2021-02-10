import React, { Component }  from "react";
import {connect} from 'react-redux';

import { getExamByID } from "../../../../../helpers/classes";

import Content from '../containers/Content';

class Main extends Component {
    constructor(){
        super();

        this.state = {
            classID: '',
            examID: '',
            dt: [],
            user: []
        } 
    }

    static getDerivedStateFromProps(props, state) {
        
        return{...state, user: JSON.parse(props.user)}
    } 

    async componentDidMount() {
        
        let classID = this.props.match.params.class_id;
        let examID = this.props.match.params.exam_id;

        let dt = await getExamByID(examID, this.state.user.access_token);

        this.setState({ classID, examID, dt });
    }

    render() {
        const { classID, dt } = this.state;

        return (
            <div id="main-content">
                <div className="container-fluid">
                    <div className="block-header">
                        <div className="row clearfix">
                            <div className="col-md-6 col-sm-12">
                                <h2>{dt && dt.testexam_title}</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="/">Home</a></li>
                                        <li className="breadcrumb-item">Classes</li>
                                        <li className="breadcrumb-item"><a href={'/classes/'+classID+'/exams'}>Exams</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">Exam Code : {dt && dt.testexam_code}</li>
                                    </ol>
                                </nav>
                            </div> 
                        </div>
                    </div>

                    <div className="row clearfix">
                        <Content {...this.state} />
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
