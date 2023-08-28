import React from 'react';
import { Provider } from 'react-redux'
import {store} from './reducers/store'
import ReactDOM from 'react-dom';
import ProjectRouter from './routes';

if (document.getElementById('app')){
    ReactDOM.render(  
      <Provider store={store}>
        <ProjectRouter/>
      </Provider>,
      document.getElementById('app')
    )
}
