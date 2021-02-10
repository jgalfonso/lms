import React from 'react';
import ReactDOM from 'react-dom';
import { SnackbarProvider } from 'notistack';
import { Provider } from 'react-redux';
import { createStore, applyMiddleware } from 'redux';
import { BrowserRouter as Router } from 'react-router-dom';
import thunk from 'redux-thunk';

import reducers from './reducers';

const createStoreWithMiddleware = applyMiddleware(thunk)(createStore);
const store = createStoreWithMiddleware(reducers, window.__INITIAL_STATE__ );

const routes = require('./routes/index').default();

function Index() {
    return (
         <Provider store={store}>
            <SnackbarProvider maxSnack={3} anchorOrigin={{ vertical: 'bottom', horizontal: 'right'}} >
                <Router>
                    { routes }
                </Router>
            </SnackbarProvider>  
        </Provider>
    )
}

ReactDOM.render(<Index />, document.getElementById('root'))