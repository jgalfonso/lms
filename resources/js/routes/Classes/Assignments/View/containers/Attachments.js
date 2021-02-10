import React, { Component } from "react";
import moment from 'moment';

class Attachments extends Component {
    render() {
        const { data } = this.props;

        return (
            <div className="col-12">
                <h5 style={{ marginBottom: "0" }}>Attached Document/s</h5>
                <p style={{ marginBottom: "5px" }}><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></p>
            
                <div className="table-responsive">
                    <table className="table header-border table-hover table-custom spacing5">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th style={{ width: "30%" }}>Filename</th>
                                <th style={{ width: "15%" }}>Date Created</th>
                            </tr>
                        </thead>

                        <tbody>
                            {
                                data.attachments && data.attachments.map((data, index) => {
    
                                    return (
                                        <tr>
                                            <th className="w30 text-center"><i className="fa fa-external-link"></i></th>
                                            <td><a href={data.attachment_embed_link} target="_blank">{data.attachment_title}</a></td>
                                            <td>{data.attachment_filename}</td>
                                            <td>{moment(data.date_created).startOf('second').fromNow()}</td>
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

export default Attachments;


