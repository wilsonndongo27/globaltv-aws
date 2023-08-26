import React from 'react';
import { Provider } from 'react-redux'
import {store} from './reducers/store'
import ReactDOM from 'react-dom';
import Home from './screens/Home';

if (document.getElementById('app')){
    ReactDOM.render(  
      <Provider store={store}>
        <Home/>
      </Provider>,
      document.getElementById('app')
    )
}
