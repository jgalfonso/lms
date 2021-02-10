import React, { Component } from "react";
import moment from 'moment';

function distinct(items, mapper) {
    if (!mapper) mapper = (item)=>item;

    return items.map(mapper).reduce((acc, item) => {
        
        if (acc.indexOf(item) === -1) acc.push(item);
        return acc;
    }, []);
}

class List extends Component {
    render() {
        const { classID, row, dt } = this.props;

        const weeks = distinct(dt, (item)=>item.weeks);

        return (
            <div className="col-md-10">
                <div className="single-blog">
                    <div className="post-content overflow" style={{ padding: "0" }}>
                        <h2 className="post-title bold">{row.class_name} - Lessons</h2>
                    </div>
                </div>

                <div className="row clearfix">
                    {
                        weeks && weeks.map((data, index) =>  {
                            
                            let dates = dt && dt.filter(item => item.weeks === data).map(function(item) { return new Date(item.date_added); })
                            let start = new Date(Math.min.apply(null, dates)); 
                            let end = new Date(Math.max.apply(null, dates)); 

                            return (
                                <div className="col-12">
                                    <div className="table-responsive">
                                        <table className="table header-border table-hover table-custom spacing5">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Lessons Overview & Resources - Week <strong>{moment(start).format("MMMM DD, YYYY")}</strong> to <strong>{moment(end).format("MMMM DD, YYYY")}</strong></th>
                                                    <th style={{ width: "15%" }}>Posted</th>
                                                    <th className="text-center" style={{ width: "10%" }}>Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                               {
                                                    dt && dt.filter(item => item.weeks === data).map((data, index) =>  {
                                
                                                       return (
                                                            <tr key={index}>
                                                                <th className="w60 text-center"><i className="fa fa-files-o"></i></th>
                                                                
                                                                <td>
                                                                    {
                                                                        data.status == 'New' && data.lesson_title || <a href={'/classes/'+classID+'/lessons/'+data.lesson_id}>{data.lesson_title}</a>
                                                                    }
                                                                </td>
                                                                
                                                                <td>{moment(data.date_added).startOf('second').fromNow()}</td>

                                                                <td className="text-center"><span className={`badge badge-${data.status == 'New' && 'default' || 'success'}`} >{data.status}</span></td>
                                                            </tr>
                                                       )
                                                    })
                                                }
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            )
                            
                        })
                    }
                </div>
            </div>       
        )
    }
}

export default List;


