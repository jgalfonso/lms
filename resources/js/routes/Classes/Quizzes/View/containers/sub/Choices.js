import React, { Component } from "react";

import { getQuizChoicesByID, answerQuiz } from "../../../../../../helpers/classes";

class Choices extends Component {
    constructor(){
        super();

        this.state = {
            dt: [],
            answer: ''
        } 
    }

    async componentDidMount() {
        
        let dt = await getQuizChoicesByID(this.props.quizDetailID, this.props.user.access_token);
        
        this.setState({ dt, answer: this.props.answer });
    }

    answer = async (value) => {

        const { quizID, quizCode, quizParticipantID, quizDetailID, quizAnswer, user } = this.props;
        const data = new FormData();
        data.append('quizID', quizID);
        data.append('quizCode', quizCode);
        data.append('quizParticipantID', quizParticipantID);
        data.append('quizDetailID', quizDetailID);
        data.append('answer', value);
        data.append('isCorrect', quizAnswer === value ? 1 : null);
        
        this.setState({ answer: value });

        await answerQuiz(data, user.access_token).then(response => {
            
           
        });  
    }

    render() {
        const { dt, answer } = this.state;

        return (
             <div className="row clearfix">
                {
                    dt && dt.map((data, index) => {
                        let checked = answer === data.quiz_choices_name && 'checked' || null;

                        return (
                            <div key={index} className="col-6">
                                <div className="fancy-radio">
                                    <label><input onChange={() => this.answer(data.quiz_choices_name)} name={this.props.quizDetailID} checked={checked} type="radio" /><span><i></i>{data.quiz_choices_name}</span></label>
                                </div>
                            </div>
                        )
                    })
                }
             </div>
        )
    }
}

export default Choices;


