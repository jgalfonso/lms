import React, { Component }  from "react";
import { withSnackbar } from 'notistack';

import snackBar from '../../../../helpers/snackbar';
import { getIP } from "../../../../helpers/lib";
import { signIn } from "../../../../helpers/auth";

import Loader from "../../../../components/loader/Bar";
import history from '../../../../utils/history';

class SignIn extends Component {
	constructor(){
        super();
        this.state = {
            username: '',
            password: '',
            loading: false
        }
    }

   	componentDidMount() {
		const { location, history } = this.props;

		location.state !== undefined && (
            setTimeout(() => {

            	location.state.success && snackBar.show(this.props, location.state.message, location.state.variant);
                history.replace();
            }, 1500)
        ) 
    }
    
    handleChange = (e) => {
        this.setState({
          	[e.target.name]: e.target.value
        });
    }	

    handleCheck = (e) => {
        this.setState({
          	[e.target.name]: e.target.checked
        });
    }	

    handleSubmit = async (e) => {
        e.preventDefault();
       
        const { username, password } = this.state;
        const data = new FormData();
        data.append('username', username);
        data.append('password', password);
        data.append('ipAddress', await getIP());

        this.setState({ loading: true });

        await signIn(data).then(response => {
            this.setState({ loading: false })

            if (response.success) {
                
                localStorage["lmsappState"] = JSON.stringify(response); 
                history.push({ pathname: '/admin/dashboard', state: { success: true, message: 'Signed in successfully.', variant: 'success' } });
            }
            else snackBar.show(this.props, response.message, 'error');
        });   
    }

	render() {
		const { loading } = this.state;
		
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

                        <div className="card">
                            <div className="body">
                                <span style={{ color: "#000", fontSize: "30px" }}>a<b>LMS</b> DHVSU</span>
                                <p className="lead" style={{ marginTop: "30px" }}>Already have an account?</p>

                                <form onSubmit={this.handleSubmit} className="form-auth-small m-t-20">
                                    <div className="form-group">
                                        <label htmlFor="username" className="control-label sr-only">Email</label>
                                        <input
                                            onChange={this.handleChange}  
                                            type="text" name="username" className="form-control round" placeholder="Username" required />
                                    </div>

                                    <div className="form-group">
                                        <label htmlFor="password" className="control-label sr-only">Password</label>
                                        <input 
                                            onChange={this.handleChange} 
                                            type="password" name="password" className="form-control round" placeholder="Password" required autoComplete="false" />
                                    </div>
                                    
                                    <div className="form-group clearfix">
                                        <label className="fancy-checkbox element-left">
                                            <input type="checkbox" />
                                            <span>Remember me</span>
                                        </label>                                
                                    </div>
                                    
                                    <button type="submit" className="btn btn-primary btn-round btn-block">LOGIN</button>
                                    
                                    <div className="bottom">
                                        <span className="helper-text m-b-10"><i className="fa fa-lock"></i> <a href="">Forgot password?</a></span>
                                        <span>Don't have an account? <a href="">Register</a></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="particles-js"><canvas className="particles-js-canvas-el" width="1425" height="257" style={{ width: "100%", height: "100%" }}></canvas></div>
                </div>

                <Loader loading={loading} />
        	</>
        )
    }
}

export default withSnackbar(SignIn);