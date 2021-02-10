import React, { Component } from "react";
import moment from 'moment';

class Submitted extends Component {
    render() {
        const { data } = this.props;

        return (
            <div className="col-12" style={{ marginTop: "15px" }}>
                <h5 style={{ marginBottom: "0" }}>Submitted Document/s</h5>
                <p style={{ marginBottom: "5px" }}><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></p>
            
                <div className="table-responsive">
                    <table className="table header-border table-hover table-custom spacing5">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Filename</th>
                                <th style={{ width: "15%" }}>Date Created</th>
                            </tr>
                        </thead>

                        <tbody>
                            {
                                data && data.map((data, index) => {
    
                                    return (
                                        <tr>
                                            <th className="w30 text-center"><i className="fa fa-external-link"></i></th>
                                            <td><a href={data.attachment_embed_link} target="_blank">{data.submitted_file}</a></td>
                                            <td>{moment(data.date_submitted).startOf('second').fromNow()}</td>
                                        </tr>
                                    )
                                })
                            }
                        </tbody>
                    </table>
                </div>
            </div>       
        )
    }
}

export default Submitted;


