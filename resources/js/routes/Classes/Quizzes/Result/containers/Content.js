import React, { Component } from "react";
import moment from 'moment';


class Content extends Component {
    constructor(){
        super();
    }

    render() {
        const { classID, quizParticipantID, dt } = this.props;

        return (
            <div className="col-12">
                <div className="single-blog">
                    <div className="post-content overflow" style={{ padding: "0" }}>
                        <h2 className="post-title bold">{dt.overview.quiz_name} - Result</h2>
                       
                        <div className="post-bottom overflow" style={{ marginBottom: "30px" }}>
                            <ul className="nav navbar-nav post-nav" style={{ width: "100%" }}>
                                <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-calendar"></i>Start : {moment(dt.overview.dt_start).format('LLL')}</li>
                                <li style={{ marginRight: 0 }}><i className="fa fa-calendar"></i>End: {moment(dt.overview.dt_end).format('LLL')}</li>
                            </ul>

                            <ul className="nav navbar-nav post-nav" style={{ width: "100%" }}>
                                <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-star"></i>Points : {dt.overview.score} / {dt.overview.length}</li>
                                <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-check"></i>Attempts : {dt.overview.attempt}</li>
                                <li style={{ marginRight: 0 }}><i className="fa fa-warning"></i>Allowed Attempts : {dt.overview.allowed_attempts}</li>
                                
                            </ul>
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

                                            <p>{data.student_answer} {data.is_correct && <i className="fa fa-check text-success"></i> || <i className="fa fa-times text-danger"></i>}</p>
                                        </div>
                                    </div>
                                )
                            })
                        } 
                    </div>
                </div>
            </div>
        )
    }
}

export default Content;


