import React, { Component }  from "react";
import {connect} from 'react-redux';
import { withSnackbar } from 'notistack';
import { Calendar, momentLocalizer } from "react-big-calendar";
import moment from "moment";

import "./App.css";
import "react-big-calendar/lib/css/react-big-calendar.css";

import snackBar from '../../../helpers/snackbar';
import history from '../../../utils/history';

const localizer = momentLocalizer(moment);

class CalendarEvents extends Component {
	constructor(){
        super();

        this.state = {
            events: [
              {
                start: moment().toDate(),
                end: moment()
                  .add(1, "days")
                  .toDate(),
                title: "Quizess"
              }
            ],
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
                                <h2>Calendar</h2>

                                <nav aria-label="breadcrumb">
                                    <ol className="breadcrumb">
                                    <li className="breadcrumb-item"><a href="/">Home</a></li>
                                    <li className="breadcrumb-item active" aria-current="page">Calendar</li>
                                    </ol>
                                </nav>
                            </div>     
                        </div>
                    </div>

                    <div className="row clearfix">
                        <div className="col-md-12">
                             <div class="card">
                                <div class="body">
                                    <Calendar
          localizer={localizer}
          defaultDate={new Date()}
          defaultView="month"
          events={this.state.events}
          style={{ height: "100vh" }}
        />
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

export default connect(mapStateToProps)(withSnackbar(CalendarEvents));