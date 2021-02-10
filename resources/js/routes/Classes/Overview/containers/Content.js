import React, { Component } from "react";
import parse from 'html-react-parser';

class Content extends Component {
    render() {
        const { data } = this.props;
        
        let avatar = data.attachment_path && data.attachment_filename && (<img className="rounded-circle" src={data.attachment_path+data.attachment_filename} alt="" />) || <div className="rounded-circle avtar-pic w90 bg-orange"><span>{data.initial}</span></div>;
    
        return (
            <div className="col-md-10">
                <div className="single-blog">
                    <div className="post-content overflow" style={{ padding: "0" }}>
                        <h2 className="post-title bold">{data.class_name} - Overview</h2>
                        <h3 className="post-author"><a href="#">Posted by Teacher <strong>{data.first_name} {data.middle_name && data.middle_name} {data.last_name}</strong></a></h3>

                        <div className="post-bottom overflow" style={{ marginBottom: "30px" }}>
                            <ul className="nav navbar-nav post-nav">
                                <li><a href="#"><i className="fa fa-users"></i>{data.participants} Participants</a></li>
                                <li><a href="#"><i className="fa fa-calendar"></i>{data.semester}</a></li>
                            </ul>
                        </div>

                        <p style={{ whiteSpace: "pre-wrap" }}>{data.class_description && parse(data.class_description)}</p>

                        <div className="card c_grid c_blue" style={{ width: "300px", display: "block", marginTop: "30px" }}>
                            <div className="body text-center">
                                <div className="circle">
                                    {avatar}    
                                </div>

                                <h6 className="mt-3 mb-0">{data.first_name} {data.middle_name && data.middle_name} {data.last_name}</h6>
                                <span>{data.email_address}</span>

                                <ul className="mt-3 list-unstyled d-flex justify-content-center">
                                    <li><a href={data.fb} className="p-3" target="_blank"><i className="fa fa-facebook"></i></a></li>
                                    <li><a href={data.linkedin} className="p-3" target="_blank"><i className="fa fa-linkedin"></i></a></li>
                                </ul>

                                <button className="btn btn-default btn-sm">Message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        )
    }
}

export default Content;


