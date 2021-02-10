import React, {Component} from 'react';
import {connect} from 'react-redux';

class Bar extends Component {
  	
  	render() {
        let loading = this.props.loading;
        
        return ( 	
    		<div className="page-loader-container" style={{ display: loading && 'block' || 'none' }} >
                <div className="loader">
                    <div className="bar1"></div>
                    <div className="bar2"></div>
                    <div className="bar3"></div>
                    <div className="bar4"></div>
                    <div className="bar5"></div>
                </div>
            </div>
        );
    }
}

export default Bar;