import React, { Component }  from "react";
import {connect} from 'react-redux';
import { withSnackbar } from 'notistack';

import snackBar from '../../../helpers/snackbar';
import history from '../../../utils/history';

class Forums extends Component {
	constructor(){
        super();

        this.state = {
            user: []
        } 
    }

    static getDerivedStateFromProps(props, state) {
        
        return{...state, user: JSON.parse(props.user)}
    } 


   	async componentDidMount() {
		const { location, history } = this.props;

        location.state !== undefined && (
            setTimeout(() => {

            	location.state.success && snackBar.show(this.props, location.state.message, location.state.variant);
                history.replace();
            }, 1500)
        ) 
    }
    

	render() {
        const { dt } = this.state;

		return (
        	<div id="main-content">
                <div className="container-fluid">
                    <div className="block-header">
                        <div className="row clearfix">
                            <div className="col-md-6 col-sm-12">
                                <h2>Forums</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                    <li className="breadcrumb-item"><a href="/">Home</a></li>
                                    <li className="breadcrumb-item active" aria-current="page">Forums</li>
                                    </ol>
                                </nav>
                            </div>     
                        </div>
                    </div>

                    <div className="row clearfix">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="body">
                                    <ul class="timeline timeline-split">
                                        <li class="timeline-item">
                                            <div class="timeline-info">
                                                <span>Dec 04, 2020</span>
                                            </div>
                                            <div class="timeline-marker"></div>
                                            
                                            <div class="timeline-content">
                                                <h3 class="timeline-title">Parramatta WordPress Meetup</h3>
                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>
                                                <a href="" class="fs--16 text-default pull-left"><i class="fa fa-comments"></i> 8 comments</a>
                                                <br />

                                                <div class="chatapp_body" style={{ margin: "15px 0 0 0", border: 0 }}>
                                                    <div class="chat-history" style={{ padding: "5px 0", borderTop: "1px dashed #e1e8ed" }}>
                                                        <ul class="message_data">
                                                            <li class="left clearfix">
                                                                <img class="user_pix" src="assets/images/default.png" alt="avatar" />
                                                               
                                                                <div class="message">
                                                                    <span>Hi Aiden, how are you?<br /> The parts of the computer that you can see and touch, such as the keyboard, monitor and the mouse are called hardware. The instructions that direct the computer are called software or computer program.</span>
                                                                </div>
                                                                
                                                                <span class="data_time">10:12 AM, Today</span>
                                                            </li>

                                                            <li class="left clearfix">
                                                                <img class="user_pix" src="assets/images/default.png" alt="avatar" />
                                                               
                                                                <div class="message">
                                                                    <span>Hi Aiden, how are you?<br /> The parts of the computer that you can see and touch, such as the keyboard, monitor and the mouse are called hardware. The instructions that direct the computer are called software or computer program.</span>
                                                                </div>
                                                                
                                                                <span class="data_time">02:03 PM, Today</span>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="chat-message clearfix" style={{ padding: "10px 0 10px 50px" }}>
                                                        <div class="input-group mb-0">
                                                            <textarea type="text" class="form-control" placeholder="Enter text here..." rows="5" ></textarea>

                                                            
                                                        </div>

                                                        <div class="align-right">
                                                            <button class="btn btn-primary" style={{ marginTop: "15px", width: "100px" }}>Post</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                <li class="timeline-item">
                                    <div class="timeline-info">
                                        <span>Dec 01, 2020</span>
                                    </div>
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h3 class="timeline-title">Share Location and Address our new office</h3>
                                        <p>795 Folsom Ave, Suite 600 San Francisco, 94107</p>
                                        
                                        <div class="chatapp_body" style={{ margin: "15px 0 0 0", border: 0 }}>
                                            <div class="chat-history" style={{ padding: "5px 0", borderTop: "1px dashed #e1e8ed" }}>
                                               
                                            </div>

                                            <div class="chat-message clearfix" style={{ padding: "10px 0 10px 50px" }}>
                                                <div class="input-group mb-0">
                                                    <textarea type="text" class="form-control" placeholder="Enter text here..." rows="5" ></textarea>

                                                    
                                                </div>

                                                <div class="align-right">
                                                    <button class="btn btn-primary" style={{ marginTop: "15px", width: "100px" }}>Post</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>                          
                                </li>                    
                                <li class="timeline-item period">
                                    <div class="timeline-info"></div>
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h2 class="timeline-title">November 2020</h2>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <div class="timeline-info">
                                        <span>Nov 16, 2020</span>
                                    </div>
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h3 class="timeline-title">Santa Cruz WordPress Monthly Meetup</h3>
                                        <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact</p>
                                        
                                        <div class="chatapp_body" style={{ margin: "15px 0 0 0", border: 0 }}>
                                            <div class="chat-history" style={{ padding: "5px 0", borderTop: "1px dashed #e1e8ed" }}>
                                               
                                            </div>

                                            <div class="chat-message clearfix" style={{ padding: "10px 0 10px 50px" }}>
                                                <div class="input-group mb-0">
                                                    <textarea type="text" class="form-control" placeholder="Enter text here..." rows="5" ></textarea>

                                                    
                                                </div>

                                                <div class="align-right">
                                                    <button class="btn btn-primary" style={{ marginTop: "15px", width: "100px" }}>Post</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <div class="timeline-info">
                                        <span>Nov 03, 2020</span>
                                    </div>
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h3 class="timeline-title">Id-Ul-Fitr Function in Office</h3>
                                        <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact</p>                           
                                        
                                        <div class="chatapp_body" style={{ margin: "15px 0 0 0", border: 0 }}>
                                            <div class="chat-history" style={{ padding: "5px 0", borderTop: "1px dashed #e1e8ed" }}>
                                               
                                            </div>

                                            <div class="chat-message clearfix" style={{ padding: "10px 0 10px 50px" }}>
                                                <div class="input-group mb-0">
                                                    <textarea type="text" class="form-control" placeholder="Enter text here..." rows="5" ></textarea>

                                                    
                                                </div>

                                                <div class="align-right">
                                                    <button class="btn btn-primary" style={{ marginTop: "15px", width: "100px" }}>Post</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-item">
                                    <div class="timeline-info">
                                        <span>Nov 01, 2020</span>
                                    </div>
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h3 class="timeline-title">Women’s Javascript Study Group</h3>                            
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                                        
                                        <div class="chatapp_body" style={{ margin: "15px 0 0 0", border: 0 }}>
                                            <div class="chat-history" style={{ padding: "5px 0", borderTop: "1px dashed #e1e8ed" }}>
                                               
                                            </div>

                                            <div class="chat-message clearfix" style={{ padding: "10px 0 10px 50px" }}>
                                                <div class="input-group mb-0">
                                                    <textarea type="text" class="form-control" placeholder="Enter text here..." rows="5" ></textarea>

                                                    
                                                </div>

                                                <div class="align-right">
                                                    <button class="btn btn-primary" style={{ marginTop: "15px", width: "100px" }}>Post</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
                    </div>
                </div>
            </div>
        )
    }
}

function mapStateToProps(state) {
    return { 
       user: state.auth.user
    }
}

export default connect(mapStateToProps)(withSnackbar(Forums));