import React, { Component } from "react";

class List extends Component {
    render() {
        const { dt } = this.props;

        return (
            <div className="col-md-10">
            	 <div className="row clearfix">
            	 	<div className="col-12">
            	 		<div className="table-responsive">
            	 			<table className="table table-hover table-custom spacing5">
            	 				<tbody>
            	 					{
		                                dt && dt.map((data, index) => {
		    								
		    								let avatar = data.attachment_path && data.attachment_filename && (data.attachment_path+'/'+data.attachment_filename) || '/assets/images/default.png';

		                                    return (
		                                    	<tr key={index}>
				                                    <td className="w60">
				                                        <img src={avatar} data-toggle="tooltip" data-placement="top" title="" alt="Avatar" className="w35 rounded" data-original-title="Avatar Name" />
				                                    </td>
				                                    <td>
				                                        <a href="" title="">{data.first_name} {data.last_name}</a>
				                                        <p className="mb-0">{data.student_no}</p>
				                                    </td>
				                                    <td>
				                                        <span>{data.email_address}</span>
				                                        <p className="mb-0">{data.mobile_no}</p>
				                                    </td>
				                                    <td>
				                                        <span>{data.course}</span>
				                                        <p className="mb-0">{data.control_no}</p>
				                                    </td>
				                                    <td className="text-right">
				                                        <button className="btn btn-success btn-sm">Message</button>
				                                    </td>
				                                </tr>
		                                    )
		                                })
		                            }
            	 				</tbody>
            	 			</table>
            	 		</div>
            	 	</div>
            	 </div>
            </div>       
        )
    }
}

export default List;


