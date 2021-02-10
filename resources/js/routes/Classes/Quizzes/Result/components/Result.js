import React, { Component }  from "react";
import {connect} from 'react-redux';
import { withSnackbar } from 'notistack';

import snackBar from '../../../../../helpers/snackbar';
import { getQuizResultByID } from "../../../../../helpers/classes";

import history from '../../../../../utils/history';

import Content from '../containers/Content';

class Result extends Component {
    constructor(){
        super();

        this.state = {
            classID: '',
            quizParticipantID: '',
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
                //history.replace();
            }, 1500)
        ) 

        let classID = this.props.match.params.class_id;
        let quizID = this.props.match.params.quiz_id;
        let quizParticipantID = this.props.location.state.quizParticipantID;

        let dt = await getQuizResultByID(quizID, quizParticipantID, this.state.user.access_token);

        this.setState({ classID, quizParticipantID, dt });
    }

    render() {
        const { classID, dt } = this.state;
        
        return (
            <div id="main-content">
                <div className="container-fluid">
                    <div className="block-header">
                        <div className="row clearfix">
                            <div className="col-md-6 col-sm-12">
                                <h2>{dt.overview && dt.overview.quiz_name} - Result</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                        <li className="breadcrumb-item"><a href="/">Home</a></li>
                                        <li className="breadcrumb-item">Classes</li>
                                        <li className="breadcrumb-item"><a href={'/classes/'+classID+'/quizzes'}>Quizzes</a></li>
                                        <li className="breadcrumb-item active" aria-current="page">Quize Code : {dt.overview && dt.overview.quiz_code}</li>
                                    </ol>
                                </nav>
                            </div> 
                        </div>
                    </div>

                    <div className="row clearfix">
                         {
                            dt.overview && (

                                <Content {...this.state} />
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

export default connect(mapStateToProps)(withSnackbar(Result));
