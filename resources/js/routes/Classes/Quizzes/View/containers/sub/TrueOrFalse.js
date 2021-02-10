import React, { Component } from "react";

import { getQuizChoicesByID, answerQuiz } from "../../../../../../helpers/classes";

class TrueOrFalse extends Component {
    constructor(){
        super();

        this.state = {
            answer: ''
        } 
    }

    componentDidMount() {
        
        this.setState({ answer: this.props.answer });
    }

    answer = async (value) => {
        const { quizID, quizCode, quizParticipantID, quizDetailID, quizAnswer, user } = this.props;
        
        const data = new FormData();
        data.append('quizID', quizID);
        data.append('quizCode', quizCode);
        data.append('quizParticipantID', quizParticipantID);
        data.append('quizDetailID', quizDetailID);
        data.append('answer', value);
        data.append('isCorrect', quizAnswer == value && 1 || null);

        this.setState({ answer: value });
        
        await answerQuiz(data, user.access_token).then(response => {
            
            
        });  
    }

   render() {   
        const { answer } = this.state;

        return (
            <div className="row clearfix">
                <div className="col-6">
                    <div className="fancy-radio">
                        <label><input onChange={() => this.answer('True')} name={this.props.quizDetailID} checked={answer === 'True' && 'checked' || null} type="radio" /><span><i></i>True</span></label>
                    </div>
                </div>

                <div className="col-6">
                    <div className="fancy-radio">
                        <label><input onChange={() => this.answer('False')} name={this.props.quizDetailID} checked={answer === 'False' && 'checked' || null} type="radio" /><span><i></i>False</span></label>
                    </div>
                </div>
             </div>
        )
    }
}

export default TrueOrFalse;


