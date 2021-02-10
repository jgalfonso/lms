import React, { Component } from "react";
import parse from 'html-react-parser';
import moment from 'moment';

class Content extends Component {
    render() {
        const { dt } = this.props;

        return (
            <div className="col-12">
                <div className="single-blog">
                    <div className="post-content overflow" style={{ padding: "0" }}>
                        <h2 className="post-title bold">{dt.testexam_title}</h2>
                       
                        <div className="post-bottom overflow" style={{ marginBottom: "30px" }}>
                            <ul className="nav navbar-nav post-nav" style={{ width: "100%" }}>
                                <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-calendar"></i>Date Posted : {moment(dt.date_added).startOf('second').fromNow()}</li>
                                <li style={{ marginRight: 0 }}><i className="fa fa-clock-o"></i>Deadline: {moment(dt.due_date).format('LLL')}</li>
                            </ul>

                            <ul className="nav navbar-nav post-nav" style={{ width: "100%" }}>
                                <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-star"></i>Points : 10</li>
                                <li style={{ width: "35%", marginRight: 0 }}><i className="fa fa-check"></i>Attempts : 1</li>
                                <li style={{ marginRight: 0 }}><i className="fa fa-warning"></i>Allowed Attempts : 2</li>
                                
                            </ul>
                        </div>

                        
                    </div>
                </div>

                <div className="col-12 ">   
                    <div className="row clearfix"> 
                        <div className="card bg-blue text-light" style={{ padding: "10px 10px 0" }}>
                            <h5><b>Instruction:</b></h5>
                            <p style={{ whiteSpace: "pre-wrap" }}>{dt.testexam_instruction && parse(dt.testexam_instruction)}</p>
                        </div>
                    </div>
                </div>

                <div className="col-12">
                    <div className="row clearfix">
                        <div className="card">
                            <div className="body">
                                <p className="card-text" style={{ whiteSpace: "pre-wrap", marginBottom: "30px" }}>
                                    <h5 className="card-title"><a href="">1. What does LIFO stand for in the context of data structures?</a></h5>
                                </p>

                                <div className="row clearfix">
                                    <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender" type="radio" /><span><i></i>List In Forward Order</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender"  type="radio"  /><span><i></i>List Forwarding</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender"type="radio"  /><span><i></i>Last In, First Out</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender" type="radio"  /><span><i></i>Last In, First Over</span></label>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        </div>

                        <div className="card">
                            <div className="body">
                                <p className="card-text" style={{ whiteSpace: "pre-wrap", marginBottom: "30px" }}>
                                    <h5 className="card-title"><a href="">2. When is the Requirements Document finished?</a></h5>
                                </p>

                                <div className="row clearfix">
                                    <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender" type="radio" /><span><i></i>Not until the customer gives it back to me after review</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender"  type="radio"  /><span><i></i>Not until after the requirements review</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender" type="radio" /><span><i></i>Not until the customer agrees that it accurately describes everything he wants the program to do.</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender"  type="radio"  /><span><i></i>Not until suggestions and requests have been incorporated into the document</span></label>
                                        </div>
                                     </div>
                                 </div>
                            </div>
                        </div>

                        <div className="card">
                            <div className="body">
                                <p className="card-text" style={{ whiteSpace: "pre-wrap", marginBottom: "30px" }}>
                                    <h5 className="card-title"><a href="">3. A data type where values can only represent one of a limited number of pre-defined categories is called a(n) _______ data type.</a></h5>
                                </p>

                                <div className="row clearfix">
                                    <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender" type="radio" /><span><i></i>Numbered</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender"  type="radio"  /><span><i></i>Category</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender" type="radio" /><span><i></i>Coded</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender"  type="radio"  /><span><i></i>Limited</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender"  type="radio"  /><span><i></i>Enumerated</span></label>
                                        </div>
                                     </div>
                                 </div>
                            </div>
                        </div>

                        <div className="card">
                            <div className="body">
                                <p className="card-text" style={{ whiteSpace: "pre-wrap", marginBottom: "30px" }}>
                                    <h5 className="card-title"><a href="">4. Which of the following translates and executes program code line by line rather than the whole program in one step?</a></h5>
                                </p>

                                <div className="row clearfix">
                                    <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender" type="radio" /><span><i></i>Translator</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender"  type="radio"  /><span><i></i>Assembler</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender" type="radio" /><span><i></i>Compiler</span></label>
                                        </div>
                                     </div>

                                     <div className="col-6">
                                        <div class="fancy-radio">
                                            <label><input name="gender"  type="radio"  /><span><i></i>Interpreter</span></label>
                                        </div>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <div className="col-12">
                    <div className="row clearfix"  style={{ textAlign: "right", display: "block", marginBottom: "30px" }} >
                        <button class="btn btn-primary">Submit Exam</button>
                    </div>
                </div>
            </div>
        )
    }
}

export default Content;


