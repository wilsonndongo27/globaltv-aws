import React, { Component } from 'react';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';

class test extends Component {
    constructor(props){
        super(props);
        this.state = {
        }
    }

    render() {
        return (
            <div>
                <h2>Salut jjjjjjjjjjjjjjjjjjjjjjjjjjjjjj</h2>
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
     }
 };

 const mapStateToProps = (state) => {
    return {
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(test);
