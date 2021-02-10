import React, { Component }  from "react";
import {connect} from 'react-redux';
import { withSnackbar } from 'notistack';

import snackBar from '../../../helpers/snackbar';
import history from '../../../utils/history';

class Dashboard extends Component {
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
                                <h2>Dashboard</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                    <li className="breadcrumb-item"><a href="/">Home</a></li>
                                    <li className="breadcrumb-item active" aria-current="page">Dashboard</li>
                                    </ol>
                                </nav>
                            </div>     
                        </div>
                    </div>

                    <div className="row clearfix">
                        <div class="col-lg-8 col-md-12">
                            <div class="row clearfix">
                                <div class="col-3 ">
                                    <div class="card">
                                        <div class="body ribbon">
                                            <div class="ribbon-box green">5</div>
                                            <a href="users.html" class="my_sort_cut text-muted">
                                                <i class="icon-users"></i>
                                                <span>Participants</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="card">
                                        <div class="body">
                                            <a href="holidays.html" class="my_sort_cut text-muted">
                                                <i class="icon-like"></i>
                                                <span>Holidays</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="card">
                                        <div class="body ribbon">
                                            <div class="ribbon-box orange">8</div>
                                            <a href="events.html" class="my_sort_cut text-muted">
                                                <i class="icon-calendar"></i>
                                                <span>Events</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="card">
                                        <div class="body">
                                            <a href="payroll.html" class="my_sort_cut text-muted">
                                                <i class="icon-notebook"></i>
                                                <span>Modules</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row clearfix">

                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>Classes Statistics</h2>
                                        </div>
                                        <div class="body text-center">
                                            <div id="chart-bar-stacked" ></div>
                                            <hr />
                                            <div class="row clearfix">
                                                <div class="col-6">
                                                    <h6 class="mb-0">50</h6>
                                                    <small class="text-muted">Male</small>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="mb-0">17</h6>
                                                    <small class="text-muted">Female</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>Performance Rating</h2>
                                        </div>
                                        <div class="body text-center">
                                            <div id="chart-area-spline-sracked" ></div>
                                            <hr />
                                            <div class="row clearfix">
                                                <div class="col-6">
                                                    <h6 class="mb-0">195</h6>
                                                    <small class="text-muted">Last Month</small>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="mb-0">163</h6>
                                                    <small class="text-muted">This Month</small>
                                                </div>
                                            </div>
                                        </div>                     
                                    </div>
                                   
                            
                                </div>
                                
                            </div>


                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="body">
                                    <div class="card-value float-right text-warning"><i class="wi wi-day-cloudy"></i></div>
                                    <h3 class="mb-1">18°C</h3>
                                    <div>Pampanga, PHL</div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="header">
                                    <h2>Event Calendar</h2>
                                   
                                </div>

                                <div class="body">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-in-bg bg-azura text-white rounded-circle">15</div>
                                        <div class="ml-4">
                                            <span>Feb 2019</span>
                                            <h4 class="mb-0 font-weight-medium">Saturday</h4>
                                        </div>
                                    </div>

                                    <table class="table table-calendar mb-0 mt-5">
                                        <tbody>
                                            <tr>
                                                <th>Mo</th>
                                                <th>Tu</th>
                                                <th>We</th>
                                                <th>Th</th>
                                                <th>Fr</th>
                                                <th>Sa</th>
                                                <th>Su</th>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">27</td>
                                                <td class="text-muted">28</td>
                                                <td class="text-muted">29</td>
                                                <td class="text-muted">30</td>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td><a href="javascript:void(0)" class="table-calendar-link">4</a></td>
                                                <td>5</td>
                                                <td><a href="javascript:void(0)" class="table-calendar-link">6</a></td>
                                                <td>7</td>
                                                <td>8</td>
                                                <td>9</td>
                                                <td>10</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td><a href="javascript:void(0)" class="table-calendar-link">12</a></td>
                                                <td>13</td>
                                                <td>14</td>
                                                <td><a href="javascript:void(0)">15</a></td>
                                                <td>16</td>
                                                <td>17</td>
                                            </tr>
                                            <tr>
                                                <td>18</td>
                                                <td><a href="javascript:void(0)" class="table-calendar-link">19</a></td>
                                                <td><a href="javascript:void(0)" class="table-calendar-link">20</a></td>
                                                <td>21</td>
                                                <td>22</td>
                                                <td>23</td>
                                                <td>24</td>
                                            </tr>
                                            <tr>
                                                <td>25</td>
                                                <td>26</td>
                                                <td>27</td>
                                                <td>28</td>
                                                <td>29</td>
                                                <td>30</td>
                                                <td class="text-muted">1</td>
                                            </tr>
                                        </tbody>
                                    </table>
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

export default connect(mapStateToProps)(withSnackbar(Dashboard));