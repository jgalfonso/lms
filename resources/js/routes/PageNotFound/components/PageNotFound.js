import React, { Component }  from "react";
import history from '../../../utils/history';

class PageNotFound extends Component {
	returnBack = (e) => {
		e.preventDefault();

		history.goBack();
	}

	render() {
		return (
			<>
				<div className="pattern">
                    <span className="red"></span>
                    <span className="indigo"></span>
                    <span className="blue"></span>
                    <span className="green"></span>
                    <span className="orange"></span>
                </div>

                <div className="auth-main particles_js">
                	<div className="auth_div vivify popIn">
                		<div className="auth_brand" style={{ marginBottom: "10px" }}>
                            <a className="navbar-brand"><img src="assets/images/logo1.png" className="d-inline-block align-top mr-2" alt="" style={{ width: "100px" }} /></a>
                        </div>

                        <div className="card page-400">
				            <div className="body">
				                <p className="lead mb-3"><span className="number left">404 </span><span className="text">Oops! <br />Page Not Found</span></p>
				                <p>The page you were looking for could not be found, please <a href="javascript:void(0);">contact us</a> to report this issue.</p>
				                
				                <div className="margin-top-30">
				                    <a onClick={(e) => this.returnBack(e)} className="btn btn-round btn-default btn-block"><i className="fa fa-arrow-left"></i> <span>Go Back</span></a>
				                    <a href="/" className="btn btn-round btn-primary btn-block"><i className="fa fa-home"></i> <span>Home</span></a>
				                </div>
				            </div>
				        </div>
                	</div>

                	<div id="particles-js"><canvas className="particles-js-canvas-el" width="1425" height="257" style={{ width: "100%", height: "100%" }}></canvas></div>
                </div>
			</>
	    )
	}
}

export default PageNotFound;
