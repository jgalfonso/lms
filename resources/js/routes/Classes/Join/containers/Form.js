import React, { Component } from "react";
import { withSnackbar } from 'notistack';

import Loader from "../../../../components/loader/Bar";
import snackBar from '../../../../helpers/snackbar';

import { joinClass } from "../../../../helpers/classes";

class Form extends Component {
    constructor(props) {
        super(props);
        this.form = React.createRef();

        this.state = {
            code: '',
            loading: false
        } 
    }

    handleChange = e => {
        this.setState({
            [e.target.name]: e.target.value
        });
    }  

    handleSubmit = async (e) => {
        e.preventDefault();

        if (this.form.current.reportValidity()) {
            
            this.setState({ loading: true });

            const dt = new FormData();
            dt.append('classCode', this.state.code);

            await joinClass(dt, this.props.user.access_token).then(response => {
                 
                this.setState({ loading: false });
                
                if (response.success) {

                    snackBar.show(this.props, 'Class to further review/pending for approval.', 'success');
                    this.props.onSuccess();
                    
                    this.setState({ code: '' });
                }
                else snackBar.show(this.props, response.message, 'error');
            });  
        }
    }

    render() {
        const { code, loading } = this.state;

        return (
            <>
                <div className="col-12">
                    <div className="card">
                        <div className="body">
                            <form ref={this.form}>
                                <div className="row">
                                    <div className="col-lg-4 col-md-4 col-sm-6">
                                        <label>Class Code:</label>
                                        <div className="input-group">
                                            <input 
                                                onChange={this.handleChange} 
                                                value={code}
                                                type="text" name="code" className="form-control" placeholder="Search..." required />
                                        </div>
                                    </div>

                                    <div className="col-lg-2 col-md-4 col-sm-6">
                                        <label>&nbsp;</label>
                                        <button 
                                            onClick={(e) => this.handleSubmit(e)}
                                            type="button" className="btn btn-primary btn-block">Join</button>
                                    </div>
                                       
                                 
                                    <div className="col-lg-6 col-md-4 col-sm-6">
                                      
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <Loader loading={loading} />
            </>
        )
    }
}

export default withSnackbar(Form);


