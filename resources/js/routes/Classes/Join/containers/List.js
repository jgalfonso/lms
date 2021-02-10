import React, { Component } from "react";

import { isNotEmpty } from "../../../../helpers/lib";

class List extends Component {
    constructor(props) {
        super(props);
    }

  render() {
        const { dt1, dt2 } = this.props;

        return (
            <>
                {
                    isNotEmpty(dt1) && (
                            <div className="col-12">
                                <div className="card">
                                    <div className="header">
                                        <h2>Active Classes <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></h2>
                                    </div>

                                    <div className="table-responsive">
                                        <table className="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                                             <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th style={{ width: "15%" }}>Class Code</th>
                                                    <th className="text-center" style={{ width: "15%" }}>Type</th>
                                                    <th style={{ width: "25%" }}>Teacher</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                {
                                                    dt1.map((data, index) => {
                        
                                                        return (
                                                            <tr key={index}>
                                                                <td>
                                                                    <div className="font-15"><a href={'/classes/'+data.class_id+'/overview'}>{data.class_name}</a></div>
                                                                </td>
                                                                <td>{data.class_code}</td>
                                                                <td className="text-center"><span className="badge badge-success text-uppercase">{data.class_type}</span></td>
                                                                <td><a href="">{data.first_name} {data.middle_name && data.middle_name} {data.last_name}</a></td>
                                                            </tr>
                                                        )
                                                    })
                                                }
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        )
                }

                {

                    isNotEmpty(dt2) && (

                            <div className="col-12">
                                <div className="card">
                                    <div className="header">
                                        <h2>Pending Approval <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></h2>
                                    </div>

                                    <div className="table-responsive">
                                        <table className="table table-hover js-basic-example dataTable table-custom spacing5 mb-0">
                                             <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th style={{ width: "15%" }}>Class Code</th>
                                                    <th className="text-center" style={{ width: "15%" }}>Type</th>
                                                    <th style={{ width: "25%" }}>Teacher</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                {
                                                    dt2.map((data, index) => {
                        
                                                        return (
                                                            <tr key={index}>
                                                                <td>
                                                                    <div className="font-15">{data.class_name}</div>
                                                                </td>
                                                                <td>{data.class_code}</td>
                                                                <td className="text-center"><span className="badge badge-success text-uppercase">{data.class_type}</span></td>
                                                                <td><a href="">{data.first_name} {data.middle_name && data.middle_name} {data.last_name}</a></td>
                                                            </tr>
                                                        )
                                                    })
                                                }
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        )
                }
            </>
        )
    }
}

export default List;


