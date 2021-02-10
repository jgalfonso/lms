import React, { Component } from "react";
import Modal from 'react-bootstrap/Modal';
import Button from 'react-bootstrap/Button';
import { withSnackbar } from 'notistack';

import { attachProject } from "../../../../../helpers/classes";
import snackBar from '../../../../../helpers/snackbar';

import Loader from "../../../../../components/loader/Bar";
import MyUploader from '../../../../../components/utils/MyUploader';

class Form extends Component {
    constructor(props){
        super(props);
        
        this.state = {
            dt: [],
            show: false,
            files : [],
            loading: false
        }
    } 
    
    componentDidMount() {
        
        this.setState({ 
            dt: this.props.data
        });
    }

    componentDidUpdate(prevProps, prevState) {
        if (prevProps.show != this.props.show) {
            
            this.setState({ 
                show: this.props.show
            });
        }
    }

    handleClose = () => {
        
        this.setState({ files: [] });

        this.props.onClose(false);
    }

    handleChange = (files) => {
        this.setState({ files })
    }

    handleSubmit = async () => {
        this.setState({ loading: true });

        const { dt, files, user } = this.state;
        const data = new FormData();

        data.append('classID', dt.class_id);
        data.append('classCode', dt.class_code);
        data.append('projectID', dt.project_id);
        data.append('projectCode', dt.project_code);
        data.append('classFolderID', dt.class_folder_id);
        data.append('projectFolderID', dt.google_folder_id);

        files.map((file) => {
            data.append('files[]', file);
        });

        await attachProject(data, this.props.user.access_token).then(response => {
            
            this.setState({ loading: false });

            if(response.success) snackBar.show(this.props, 'Successfully attached documents...', 'success');
            else snackBar.show(this.props, response.message, 'error'); 
            
            this.props.onSuccess();
            this.handleClose();
            
        });  
    }

    render() {
        const { show, loading } = this.state;
        
        return (
            <>
                <Modal show={show} onHide={this.handleClose} size="lg" backdrop="static">
                    <Modal.Header closeButton>
                        <Modal.Title>File Attachment</Modal.Title>
                    </Modal.Header>
                    
                    <Modal.Body>
                        <div id="dragDrop">
                            <div className="border--dash">
                                <div className="file btn btn-sm btn-default">
                                    {
                                        <MyUploader files={this.state.files} getFileFunction={this.handleChange}  />
                                    }

                                    <p className="pt--20 pb--20 text-default">Min. file size. 2MB, Max. file size: 10.6MB.</p>
                                </div>
                            </div>
                        </div>
                    </Modal.Body>
                    
                    <Modal.Footer>
                        <Button onClick={this.handleClose} variant="secondary">Cancel</Button>
                        <Button onClick={this.handleSubmit} variant="primary">Submit Changes</Button>
                    </Modal.Footer>
                </Modal>

                <Loader loading={loading} />
            </>
        )
    }
}

export default withSnackbar(Form);


