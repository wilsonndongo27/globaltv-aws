import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import NavBarBlock from '../components/NavBar';
import LiveTV from '../components/LiveTv';
import Footer from '../components/Footer';
import {detailViewAction, homeActionData} from '../reducers/actions';
import { Ring } from "react-awesome-spinners";
import  secureLocalStorage  from  "react-secure-storage";
import Details from '../components/Details';

class DetailPage extends Component {
    constructor(props){
        super(props);
        this.state = {
            detailkey:''
        }
    }

    componentDidMount(){
        this._detailData();
    }

    _detailData = async () => {
        const info = await secureLocalStorage.getItem('detailkey');
        if(info != null){
            var data = JSON.parse(info);
            await detailViewAction(data);
            await homeActionData();
            this.setState({detailkey:data.key});
        }
    }

    render () {
        const {is_loading} = this.props;
        return (
            <div className='body'>
                <div className='fixedblock'>   
                    <NavBarBlock />
                    <LiveTV />
                </div>
                {
                    is_loading ?
                        <Ring className='styleloader'/>
                    :null
                }
                <Details detailkey={this.state.detailkey} />
                <Footer />
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
   return {
        ...bindActionCreators({detailViewAction, homeActionData}, dispatch)
    }
};

const mapStateToProps = (state) => {
   return {
        visibleMore:state.navigation.visibleMore,
        is_loading:state.loading.is_loading,
        detail_view: state.dataManager.detail_view,
   }
 }

export default connect(mapStateToProps, mapDispatchToProps, null)(DetailPage);
