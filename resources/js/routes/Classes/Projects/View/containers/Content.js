import React, { Component } from "react";
import parse from 'html-react-parser';
import moment from 'moment';

class Content extends Component {
    render() {
        const { data } = this.props;

        return (
            <>
                <div className="col-12">
                    <div className="single-blog">
                        <div className="post-content overflow" style={{ padding: "0" }}>
                            <h2 className="post-title bold">{data.overview.project_title}</h2>

                             <div className="post-bottom overflow" style={{ marginBottom: "30px" }}>
                                <ul className="nav navbar-nav post-nav" style={{ width: "100%" }}>
                                    <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-calendar"></i>Date Posted : {moment(data.overview.date_added).startOf('second').fromNow()}</li>
                                    <li style={{ marginRight: 0 }}><i className="fa fa-clock-o"></i>Deadline: {moment(data.overview.due_date).format('LLL')}</li>
                                </ul>

                                <ul className="nav navbar-nav post-nav" style={{ width: "100%" }}>
                                    <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-star"></i>Points : 0</li>
                                    <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-check"></i>Attempts : 0</li>
                                    <li style={{ marginRight: 0 }}><i className="fa fa-warning"></i>Allowed Attempts : 0</li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="col-12">
                    <div className="card">
                        <div className="body">
                            <h5 className="card-title"><a href="">Instructions:</a></h5>

                            <p className="card-text" style={{ whiteSpace: "pre-wrap" }}>
                                {data.overview.project_description && parse(data.overview.project_description)}
                            </p>

                            {
                                data.links && (
                                    <>
                                        <h5 className="card-title" style={{ marginTop: "30px" }}><a href="">Links:</a></h5>

                                        {
                                            data.links && data.links.map((data, index) => {
                
                                                return (
                                                    <p key={index} style={{ marginBottom: "5px" }}><i className="fa fa-link"></i> <a href={data.link_url} target="_blank">{data.link_title}</a></p>
                                                )
                                            })
                                        }
                                    </>
                                )
                            }
                        </div>
                    </div>
                </div>
            </>
        )
    }
}

export default Content;


    