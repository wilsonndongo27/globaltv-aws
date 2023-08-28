import React, { Component } from 'react';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Home from '../screens/Home';

class ProjectRouter extends Component {
    constructor(props){
        super(props);
        this.state = {
        }
    }

    render() {
        return (
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Home />} />
                </Routes>
            </BrowserRouter>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        ...bindActionCreators({}, dispatch)
    }
 };

 const mapStateToProps = (state) => {
    return {
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(ProjectRouter);
