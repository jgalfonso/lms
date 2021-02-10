import React, { Component } from "react";

import { getQuizChoicesByID, answerQuiz } from "../../../../../../helpers/classes";

class Essay extends Component {
    constructor(){
        super();

        this.state = {
            answer: ''
        } 
    }

    componentDidMount() {
        
        this.setState({ answer: this.props.answer });
    }

    handleChange = e => {
        this.setState({
            [e.target.name]: e.target.value
        });
    }  

    answer = async (e) => {
        const { quizID, quizCode, quizParticipantID, quizDetailID, user } = this.props;
        
        const data = new FormData();
        data.append('quizID', quizID);
        data.append('quizCode', quizCode);
        data.append('quizParticipantID', quizParticipantID);
        data.append('quizDetailID', quizDetailID);
        data.append('answer', e.target.value);

        await answerQuiz(data, user.access_token).then(response => {
            
           
        });  
    }

   render() {
        const { answer } = this.state;

        return (
             <div className="row clearfix">
                <div className="col-12">
                    <div className="input-group">
                        <textarea onChange={this.handleChange} onBlur={(e) => this.answer(e)} name="answer" rows="4" className="form-control no-resize" placeholder="Please type what you want..." required value={answer}></textarea>
                    </div>
                </div>
             </div>
        )
    }
}

export default Essay;


