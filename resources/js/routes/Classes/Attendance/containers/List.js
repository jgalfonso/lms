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
        const { row, dt } = this.props;

        const months = distinct(dt, (item)=>item.months);

        return (
            <div className="col-md-10">
                <div className="single-blog">
                    <div className="post-content overflow" style={{ padding: "0" }}>
                        <h2 className="post-title bold">{row.class_name} - Attendance</h2>
                    </div>
                </div>

                <div className="row clearfix">
                    {
                        months && months.map((data, index) =>  {
                             return (
                                <div className="col-12">
                                    <h5>{data}</h5>

                                    <div className="table-responsive">
                                        <table className="table table-hover table-custom spacing5">
                                            <tbody>
                                                {
                                                    dt && dt.filter(item => item.months === data).map((data, index) => {
                                                        
                                                        return (
                                                            <tr key={index}>
                                                                <td className="w60 text-center">{index+1}</td>

                                                                <td>
                                                                    <span>{moment(data.attendance_date).format('MMMM D, YYYY')}</span>
                                                                </td>

                                                                <td style={{ width: '20%' }}>
                                                                    <span>{moment(data.attendance_date).format('dddd')}</span>
                                                                </td>
                                                                
                                                                <td className="text-right" style={{ width: '20%' }}>
                                                                    <span>{moment(data.attendance_date).format('h:mm A')}</span>
                                                                </td>
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


