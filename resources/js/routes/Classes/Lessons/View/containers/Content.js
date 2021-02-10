import React, { Component } from "react";
import parse from 'html-react-parser';
import moment from 'moment';

import { isNotEmpty } from "../../../../../helpers/lib";

class Content extends Component {
    render() {
        const { data } = this.props;

        return (
            <div className="col-12">
                <div className="card">
                    <div className="body">
                        <h5 className="card-title"><a href="">{data.overview.lesson_title}</a></h5>
                        <p className="card-text"><small className="text-muted">{moment(data.overview.date_added).startOf('second').fromNow()}</small></p>

                        <p className="card-text" style={{ whiteSpace: "pre-wrap", marginTop: "30px" }}>
                            {data.overview.lesson_description && parse(data.overview.lesson_description)}
                        </p>

                        {
                            data.overview.thumb_filepath && (
                                <img className="card-img-top mb-3 rounded" src={data.overview.thumb_filepath} alt="" style={{ marginTop: "15px" }} />
                            )
                        }

                        {
                            isNotEmpty(data.links) && (
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
        )
    }
}

export default Content;


