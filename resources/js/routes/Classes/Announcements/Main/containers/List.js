import React, { Component } from "react";
import moment from 'moment';

class List extends Component {
    render() {
        const { row, dt } = this.props;

        return (
            <div className="col-md-10">
                <div className="single-blog">
                    <div className="post-content overflow" style={{ padding: "0" }}>
                        <h2 className="post-title bold">{row.class_name} - Announcements</h2>
                    </div>
                </div>

                <div className="row clearfix">
                    <div className="col-12">
                        <div className="list-group">
                            {
                                dt && dt.map((data, index) => {
    
                                    return (
                                         <div className="list-group-item list-group-item-action flex-column align-items-start">
                                            <div className="d-flex w-100 justify-content-between">
                                                <h5 className="mb-1"><a href={'/classes/'+row.class_id+'/announcements/'+data.announcement_id}>{data.title}</a></h5>
                                                <small>{moment(data.dt_created).startOf('second').fromNow()}</small>
                                            </div>
                                            
                                            <p className="mb-1" style={{ marginTop: "15px" }}>{data.details.substring(0, 250)}...</p>

                                            <p className="mb-1" style={{ marginTop: "15px" }}><code>{data.comments} Comments</code></p>
                                        </div>
                                    )
                                })
                            }
                        </div>
                    </div>
                </div>
            </div>       
        )
    }
}

export default List;


