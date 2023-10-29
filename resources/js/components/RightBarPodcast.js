import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';
import * as Icon from 'react-bootstrap-icons';
import PubImage from '../assets/img/pub.jpg';
import Moment from 'moment';
import 'moment/locale/fr';
import  secureLocalStorage  from  "react-secure-storage";
import {BaseUrl} from '../api/config';


class RightBarPodcast extends Component {
    constructor(props){
        super(props);
        this.state = {
        }
    }

    _toggleDetail = (item, key) => {

    }

    _redirectListPodcast = async () => {
        const data = {
            'key':5
        };
        await secureLocalStorage.setItem('listkey', JSON.stringify(data));
        window.location.assign('list/');
    }
 
    render() {
        const {allpodcast} = this.props;
        return (
            <>
                <h4 className='titlecore'>Nouveaux Podcasts </h4>
                <div className='card bodyblock3'>
                    {
                        allpodcast ?
                            allpodcast.map((item, i) => 
                                <div className='projectitem' key={i}>
                                    <img src={BaseUrl +'storage/'+ item.cover} className='imageproject'/>
                                    <div className='timeproject'>
                                        <p>
                                            <span>Publier, {Moment(item.created_at).fromNow()}</span>
                                            <span><Icon.Dot/> {item.program}</span> 
                                        </p>
                                    </div>
                                    <div className='titleproject'>
                                        <a href='#' >{item.title}</a>
                                    </div>
                                </div>
                            )
                        :null
                    }

                    <div className='blockbtnallproject'>
                        <a href='#' className='btn  btn-lg allprojectbtn' onClick={this._redirectListPodcast}>Voir plus</a>
                    </div>
                </div>
                <div className='card blockpub'>
                    <img src={PubImage} className='imagepub'/>
                </div>
            </>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
       dispatch,
       ...bindActionCreators(dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
         ...state
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(RightBarPodcast);
