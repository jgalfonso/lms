import React, {Component} from 'react';

class SearchBar extends Component {
	 render() {
    	return (
            <div className="search_div">
                <div className="card">
                    <div className="body">
                        <form id="navbar-search" className="navbar-form search-form">
                            <div className="input-group mb-0">
                                <input type="text" className="form-control" placeholder="Search..." />
                                <div className="input-group-append">
                                    <span className="input-group-text"><i className="icon-magnifier"></i></span>
                                    <a className="search_toggle btn btn-danger"><i className="icon-close"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>            
                </div>

                <span>Search Result <small className="float-right text-muted">About 90 results (0.47 seconds)</small></span>
            </div>
        );
    }
}

export default SearchBar;