import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import NavBarBlock from '../components/NavBar';
import LiveTV from '../components/LiveTv';
import Core from '../components/Core';
import Footer from '../components/Footer';
import Lists from '../components/Lists';
import {homeActionData} from '../reducers/actions';
import { Ring } from "react-awesome-spinners";

class Home extends Component {
    constructor(props){
        super(props);
        this.state = {
        }
    }

    componentDidMount(){
        this._homeData();
    }

    _homeData = () => {
        homeActionData();
    }

    render () {
        const {is_loading} = this.props;
        return (
            <div className='body'>
                <div className='fixedblock'>   
                    <NavBarBlock />
                    <LiveTV  />
                </div>
                
                {
                    is_loading ?
                        <Ring className='styleloader'/>
                    :null
                }
                <Core />
                <Footer/>
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
   return {
        ...bindActionCreators({homeActionData}, dispatch)
    }
};

const mapStateToProps = (state) => {
   return {
        visibleList:state.navigation.visibleList,
        visibleMore:state.navigation.visibleMore,
        is_loading:state.loading.is_loading,
   }
 }

export default connect(mapStateToProps, mapDispatchToProps, null)(Home);
