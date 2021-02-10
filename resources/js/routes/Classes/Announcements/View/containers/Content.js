import React, { Component } from "react";
import parse from 'html-react-parser';
import moment from 'moment';

class Content extends Component {
    render() {
        const { data } = this.props;

        return (
            <div className="col-12">
                <div className="card">
                    <div className="body">
                        <h5 className="card-title"><a href="">{data.title}</a></h5>
                        <p className="card-text"><small className="text-muted">{moment(data.date_added).startOf('second').fromNow()}</small></p>

                        <p className="card-text" style={{ whiteSpace: "pre-wrap", marginTop: "30px" }}>
                            {data.details && parse(data.details)}
                        </p>
                    </div>
                </div>
            </div>
        )
    }
}

export default Content;


