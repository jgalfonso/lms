import React, {Component} from 'react';

class RightBar extends Component {
	 render() {
    	return (
            <div id="rightbar" className="rightbar">
                 <div className="body">
                    <ul className="nav nav-tabs2">
                        <li className="nav-item"><a className="nav-link active" data-toggle="tab" href="#Chat-one">Chat</a></li>
                        <li className="nav-item"><a className="nav-link" data-toggle="tab" href="#Chat-list">List</a></li>
                        <li className="nav-item"><a className="nav-link" data-toggle="tab" href="#Chat-groups">Groups</a></li>
                    </ul>
                </div>
            </div>
        );
    }
}

export default RightBar;