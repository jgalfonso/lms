import React, { Component } from "react";
import Modal from 'react-bootstrap/Modal';
import Button from 'react-bootstrap/Button';
import { withSnackbar } from 'notistack';

import { submitQuiz } from "../../../../../../helpers/classes";
import snackBar from '../../../../../../helpers/snackbar';

import Loader from "../../../../../../components/loader/Bar";
import history from '../../../../../../utils/history';

class Form extends Component {
    constructor(props){
        super(props);
        
        this.state = {
            show: false,
            loading: false
        }
    } 
    
    componentDidUpdate(prevProps, prevState) {
        if (prevProps.show != this.props.show) {
            
            this.setState({ 
                show: this.props.show
            });
        }
    }

    handleClose = () => {
        
        this.props.onClose(false);
    }

    handleSubmit = async () => {
        this.setState({ loading: true });

        const { classID, quizID, quizParticipantID, user } = this.props;
    
        const data = new FormData();
        data.append('quizParticipantID', quizParticipantID);
     
        await submitQuiz(data, user.access_token).then(response => {
            
            this.setState({ loading: false });

            if(response.success)  history.push({ pathname: '/classes/'+classID+'/quizzes/'+quizID+'/result', state: { success: true, quizParticipantID: quizParticipantID, message: 'Quiz successfully completed.', variant: 'success' } });
            else snackBar.show(this.props, response.message, 'error'); 
        });
    }

    render() {
        const { show, loading } = this.state;
        
        return (
            <>
                <Modal show={show} onHide={this.handleClose} size="md" backdrop="static">
                    <Modal.Header closeButton>
                        <Modal.Title>Confirmation!</Modal.Title>
                    </Modal.Header>
                    
                    <Modal.Body>
                        <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.</p>
                    </Modal.Body>
                    
                    <Modal.Footer>
                        <Button onClick={this.handleClose} variant="secondary">Cancel</Button>
                        <Button onClick={this.handleSubmit} variant="primary">Complete, View Result</Button>
                    </Modal.Footer>
                </Modal>

                <Loader loading={loading} />
            </>
        )
    }
}

export default withSnackbar(Form);


