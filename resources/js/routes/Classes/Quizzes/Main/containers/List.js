import React, { Component } from "react";
import moment from 'moment';
import { withSnackbar } from 'notistack';

import { takeQuiz } from "../../../../../helpers/classes";
import snackBar from '../../../../../helpers/snackbar';

import Loader from "../../../../../components/loader/Bar";
import history from '../../../../../utils/history';

class List extends Component {
    constructor(props){
        super(props);
        
        this.state = {
            classID: '',
            row: [],
            dt: [],
            loading: false
        }
    } 

    componentDidUpdate(prevProps, prevState) {
        if (prevProps != this.props) {
            
            this.setState({ 
               ...this.props
            });
        }
    }

    take = async (classID, quizID, length, allowedAttempts) => {
        
        this.setState({ loading: true });

        const data = new FormData();
        data.append('quizID', quizID);
        data.append('length', length);
        data.append('allowedAttempts', allowedAttempts);
        
        await takeQuiz(data, this.props.user.access_token).then(response => {
            
            this.setState({ loading: false });

            if(response.success) history.push('/classes/'+classID+'/quizzes/'+quizID);
            else snackBar.show(this.props, response.message, 'error'); 
        });  
    }

    render() {
        const { classID, row, dt, loading } = this.state;

        return (
            <div className="col-md-10">
                <div className="single-blog">
                    <div className="post-content overflow" style={{ padding: "0" }}>
                        <h2 className="post-title bold">{row.class_name} - Quizzes</h2>
                    </div>
                </div>

                <div className="row clearfix">
                    <div className="col-12">
                        <div className="table-responsive">
                            <table className="table header-border table-hover table-custom spacing5">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th style={{ width: "15%" }}>Availability</th>
                                        <th style={{ width: "15%" }}>Due Date</th>
                                        <th className="text-center" style={{ width: "10%" }}>Time Limit</th>
                                        <th className="text-center" style={{ width: "10%" }}>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {
                                        dt && dt.map((data, index) => {
                                            var availability = moment(data.date_added);
                                            var due = moment(data.due_date);
                                            var limit = due.diff(availability, 'minutes');

                                            return (
                                                <tr key={index}>
                                                    <th className="w60 text-center"><i className="fa fa-file-text-o"></i></th>
                                                    <td><a onClick={() => this.take(classID, data.quiz_id, data.length, data.allowed_attempts)}>{data.quiz_name}</a></td>
                                                    <td>{availability.format('lll')}</td>
                                                    <td>{due.format('lll')}</td>
                                                    <td className="text-center">{limit} mins</td>
                                                    <td className="text-center"><span className="badge badge-primary">{data.status}</span></td>
                                                </tr>
                                            )
                                        })
                                    }
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <Loader loading={loading} />
            </div>       
        )
    }
}

export default withSnackbar(List);


