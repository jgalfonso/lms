import React, { Component } from "react";
import parse from 'html-react-parser';
import moment from 'moment';

import Choices from './sub/Choices';
import Completion from './sub/Completion';
import TrueOrFalse from './sub/TrueOrFalse';
import Essay from './sub/Essay';
import Modal from './sub/Modal';

class Content extends Component {
    constructor(){
        super();

        this.state = {
            showModal: false,
            loading: false
        }
    }

    renderSwitch(data) {
        const { dt, user } = this.props;

        switch(data.quiz_details_type) {
            case 'multiplechoice':
            
                return <Choices quizID={dt.overview.quiz_id} quizCode={dt.overview.quiz_code} quizParticipantID={dt.overview.quiz_participant_id} quizDetailID={data.quiz_details_id} quizAnswer={data.quiz_answer} answer={data.student_answer} user={user} />;
            
            case 'completion':

                return <Completion quizID={dt.overview.quiz_id} quizCode={dt.overview.quiz_code} quizParticipantID={dt.overview.quiz_participant_id} quizDetailID={data.quiz_details_id} quizAnswer={data.quiz_answer} answer={data.student_answer} user={user} />;

            case 'essay':

                return <Essay quizID={dt.overview.quiz_id} quizCode={dt.overview.quiz_code} quizParticipantID={dt.overview.quiz_participant_id} quizDetailID={data.quiz_details_id} answer={data.student_answer} user={user} />;
            
            default:
            
                return <TrueOrFalse quizID={dt.overview.quiz_id} quizCode={dt.overview.quiz_code} quizParticipantID={dt.overview.quiz_participant_id} quizDetailID={data.quiz_details_id} quizAnswer={data.quiz_answer} answer={data.student_answer} user={user} />;
        }
    }

    handleModal = show => {
        this.setState({ showModal: show });
    }

    handleSubmit = async (e) => {
        e.preventDefault();
        
        this.handleModal(true);
    }

    render() {
        const { classID, quizID, dt, user } = this.props;
        console.log(dt.quizzes)
        return (
            <div className="col-12">
                <div className="single-blog">
                    <div className="post-content overflow" style={{ padding: "0" }}>
                        <h2 className="post-title bold">{dt.overview.quiz_name}</h2>
                       
                        <div className="post-bottom overflow" style={{ marginBottom: "30px" }}>
                            <ul className="nav navbar-nav post-nav" style={{ width: "100%" }}>
                                <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-calendar"></i>Date Posted : {moment(dt.overview.date_added).format('LLL')}</li>
                                <li style={{ marginRight: 0 }}><i className="fa fa-clock-o"></i>Deadline: {moment(dt.overview.due_date).format('LLL')}</li>
                            </ul>

                            <ul className="nav navbar-nav post-nav" style={{ width: "100%" }}>
                                <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-star"></i>Points : {dt.overview.length}</li>
                                <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-check"></i>Attempts : {dt.overview.attempt}</li>
                                <li style={{ marginRight: 0 }}><i className="fa fa-warning"></i>Allowed Attempts : {dt.overview.allowed_attempts}</li>
                                
                            </ul>
                        </div>

                        
                    </div>
                </div>

                <div className="col-12 ">   
                    <div className="row clearfix"> 
                        <div className="card bg-pink text-light" style={{ padding: "10px 10px 0" }}>
                            <h5><b>Instruction:</b></h5>
                            <p style={{ whiteSpace: "pre-wrap" }}>{dt.overview.quiz_instruction && parse(dt.overview.quiz_instruction)}</p>
                        </div>
                    </div>
                </div>

                <div className="col-12">
                    <div className="row clearfix">
                        {
                            dt.quizzes && dt.quizzes.map((data, index) => {

                                return (
                                    <div key={index} className="card">
                                        <div className="body">
                                            <p className="card-text" style={{ whiteSpace: "pre-wrap", marginBottom: "30px" }}>
                                                <h5 className="card-title"><a href="">{data.quiz_details_number}. {data.quiz_details_question}</a></h5>
                                            </p>

                                            {this.renderSwitch(data)}
                                        </div>
                                    </div>
                                )
                            })
                        }
                    </div>
                </div>

                 <div className="col-12">
                    <div className="row clearfix" style={{ textAlign: "right", display: "block", marginBottom: "30px" }} >
                        <button onClick={(e) => this.handleSubmit(e)} className="btn btn-primary">Submit Quiz</button>
                    </div>
                </div>

                <Modal classID={classID} quizID={quizID} quizParticipantID={dt.overview.quiz_participant_id} show={this.state.showModal} onClose={this.handleModal} user={user}  />
            </div>
        )
    }
}

export default Content;


