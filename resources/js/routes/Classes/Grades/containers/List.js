import React, { Component } from "react";

class List extends Component {
    render() {
        const { data } = this.props;

        return (
            <div className="col-md-10">
                <div className="single-blog">
                    <div className="post-content overflow" style={{ padding: "0" }}>
                        <h2 className="post-title bold">{data.class_name} - Grades</h2>
                    </div>
                </div>
            </div>       
        )
    }
}

export default List;


