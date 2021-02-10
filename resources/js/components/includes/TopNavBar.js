import React, {Component} from 'react';

import { signOut } from "../../helpers/auth";
import history from '../../utils/history';

class TopNavBar extends Component {
    handleSignOut = async (e) => {
        e.preventDefault();

        let success = await signOut();
        if (success) {
                
            localStorage.removeItem('lmsappState'); 
            history.push({ pathname: '/sign-in', state: { success: true, message: 'Successfully signed out.', variant: 'success' } });
        }
    }

	 render() {
    	return (
            <nav className="navbar top-navbar">
                <div className="container-fluid">
                    <div className="navbar-left" style={{ marginLeft: "15px" }}>
                        <div className="navbar-btn">
                            <a href="/"><img src="/assets/images/logo1.png" alt="Oculux Logo" className="img-fluid logo" /></a>
                            <button type="button" className="btn-toggle-offcanvas"><i className="lnr lnr-menu fa fa-bars"></i></button>
                        </div>

                        <ul className="nav navbar-nav">
                            <li className="dropdown">
                                <a className="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i className="icon-envelope"></i>
                                    <span className="notification-dot bg-green">4</span>
                                </a>

                                <ul className="dropdown-menu right_chat email vivify fadeIn">
                                    <li className="header green">You have 4 New eMail</li>
                                    <li>
                                        <a>
                                            <div className="media">
                                                <div className="avtar-pic w35 bg-red"><span>FC</span></div>
                                                <div className="media-body">
                                                    <span className="name">James Wert <small className="float-right text-muted">Just now</small></span>
                                                    <span className="message">Update GitHub</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <div className="media">
                                                <div className="avtar-pic w35 bg-indigo"><span>FC</span></div>
                                                <div className="media-body">
                                                    <span className="name">Folisise Chosielie <small className="float-right text-muted">12min ago</small></span>
                                                    <span className="message">New Messages</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <div className="media">
                                                <div className="avtar-pic w35 bg-red"><span>FC</span></div>
                                                <div className="media-body">
                                                    <span className="name">Louis Henry <small className="float-right text-muted">38min ago</small></span>
                                                    <span className="message">Design bug fix</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <div className="media mb-0">
                                                <div className="avtar-pic w35 bg-red"><span>FC</span></div>
                                                <div className="media-body">
                                                    <span className="name">Debra Stewart <small className="float-right text-muted">2hr ago</small></span>
                                                    <span className="message">Fix Bug</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li className="dropdown" style={{ paddingLeft: "4px" }} >
                                <a className="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i className="icon-bell"></i>
                                    <span className="notification-dot bg-azura">4</span>
                                </a>

                                <ul className="dropdown-menu feeds_widget vivify fadeIn">
                                    <li className="header blue">You have 4 New Notifications</li>
                                    <li>
                                        <a>
                                            <div className="feeds-left bg-red"><i className="fa fa-check"></i></div>
                                            <div className="feeds-body">
                                                <h4 className="title text-danger">Issue Fixed <small className="float-right text-muted">9:10 AM</small></h4>
                                                <small>WE have fix all Design bug with Responsive</small>
                                            </div>
                                        </a>
                                    </li>                               
                                    <li>
                                        <a>
                                            <div className="feeds-left bg-info"><i className="fa fa-user"></i></div>
                                            <div className="feeds-body">
                                                <h4 className="title text-info">New User <small className="float-right text-muted">9:15 AM</small></h4>
                                                <small>I feel great! Thanks team</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <div className="feeds-left bg-orange"><i className="fa fa-question-circle"></i></div>
                                            <div className="feeds-body">
                                                <h4 className="title text-warning">Server Warning <small className="float-right text-muted">9:17 AM</small></h4>
                                                <small>Your connection is not private</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <div className="feeds-left bg-green"><i className="fa fa-thumbs-o-up"></i></div>
                                            <div className="feeds-body">
                                                <h4 className="title text-success">2 New Feedback <small className="float-right text-muted">9:22 AM</small></h4>
                                                <small>It will give a smart finishing to your site</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div className="navbar-right">
                        <div id="navbar-menu">
                            <ul className="nav navbar-nav">
                                <li><a className="search_toggle icon-menu" title="Search Result"><i className="icon-magnifier"></i></a></li>                        
                                <li style={{ display: 'none' }}><a className="right_toggle icon-menu" title="Right Menu"><i className="icon-bubbles"></i><span className="notification-dot bg-pink">2</span></a></li>
                                <li><a onClick={(e) => this.handleSignOut(e)} className="icon-menu"><i className="icon-power"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div className="progress-container"><div className="progress-bar" id="myBar"></div></div>
            </nav>
        );
    }
}

export default TopNavBar;