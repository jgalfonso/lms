import React, { Component } from "react";

import { getQuizChoicesByID, answerQuiz } from "../../../../../../helpers/classes";

class Completion extends Component {
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
        const { quizID, quizCode, quizParticipantID, quizDetailID, quizAnswer, user } = this.props;

        
        const data = new FormData();
        data.append('quizID', quizID);
        data.append('quizCode', quizCode);
        data.append('quizParticipantID', quizParticipantID);
        data.append('quizDetailID', quizDetailID);
        data.append('answer', e.target.value);
        data.append('isCorrect', quizAnswer == e.target.value && 1 || null);

        await answerQuiz(data, user.access_token).then(response => {
            
           
        });  
    }

   render() {
        const { answer } = this.state;
        return (
             <div className="row clearfix">
                <div className="col-3">
                    <div className="input-group">
                        <input onChange={this.handleChange} onBlur={(e) => this.answer(e)} type="text" name="answer" value={answer} className="form-control" placeholder="Answer..." required />
                    </div>
                </div>
             </div>
        )
    }
}

export default Completion;


