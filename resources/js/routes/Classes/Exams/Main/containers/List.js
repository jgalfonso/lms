import React, { Component } from "react";
import moment from 'moment';

class List extends Component {
    render() {
        const { classID, row, dt } = this.props;

        return (
            <div className="col-md-10">
                <div className="single-blog">
                    <div className="post-content overflow" style={{ padding: "0" }}>
                        <h2 className="post-title bold">{row.class_name} - Exams</h2>
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
                                        <th style={{ width: "20%" }}>Due Date</th>
                                        <th style={{ width: "10%" }}>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {
                                        dt && dt.map((data, index) => {
            
                                            return (
                                                <tr key={index}>
                                                    <th className="w60 text-center"><i className="fa fa-file-text-o"></i></th>
                                                    <td><a href={'/classes/'+classID+'/exams/'+data.testexam_id}>{data.testexam_title}</a></td>
                                                    <td>{moment(data.due_date).format('LLL')}</td>
                                                    <td><span className="badge badge-primary">{data.status}</span></td>
                                                </tr>
                                            )
                                        })
                                    }
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>       
        )
    }
}

export default List;


