import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import NavBarBlock from '../components/NavBar';
import LiveTV from '../components/LiveTv';
import Footer from '../components/Footer';
import Lists from '../components/Lists';
import {listViewAction} from '../reducers/actions';
import { Ring } from "react-awesome-spinners";
import  secureLocalStorage  from  "react-secure-storage";

class Replays extends Component {
    constructor(props){
        super(props);
        this.state = {
            listkey:''
        }
    }

    componentDidMount(){
        this._listData();
    }

    _listData = async () => {
        const info = secureLocalStorage.getItem('listkey');
        if(info != null){
            var data = JSON.parse(info);
            listViewAction(data);
            this.setState({listkey:data.key});
        }
    }

    render () {
        const {visibleList, is_loading} = this.props;
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
                <Lists listkey={this.state.listkey} />
                <Footer />
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
   return {
        ...bindActionCreators({listViewAction}, dispatch)
    }
};

const mapStateToProps = (state) => {
   return {
        visibleMore:state.navigation.visibleMore,
        is_loading:state.loading.is_loading,
   }
 }

export default connect(mapStateToProps, mapDispatchToProps, null)(Replays);
