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
import ReactPlayer from 'react-player'

class RightBarInterview extends Component {
    constructor(props){
        super(props);
        this.state = {
        }
    }

    _redirectListInterview = async () => {
        const data = {
            'key':2
        };
        await secureLocalStorage.setItem('listkey', JSON.stringify(data));
        window.location.replace(BaseUrl + 'list/');
    }

    _redirectDetail = async (id, key) => {
        const data = {
            'id':id,
            'key':key
        };
        await secureLocalStorage.setItem('detailkey', JSON.stringify(data));
        window.location.replace(BaseUrl + 'detail/'+id+'/')
    }
 
    render() {
        const {allinterview} = this.props;
        return (
            <>
                <h4 className='titlecore'>Top Interviews </h4>
                <div className='card bodyblock3'>
                    {
                        allinterview && allinterview.length > 0 ?
                            allinterview.map((item, i) => 
                                <div className='projectitem' key={i}>  
                                    {
                                        item.is_video == 0 ?
                                            <img src={BaseUrl +'storage/'+ item.cover} className='imageinterviewitem'
                                                onClick={this._redirectDetail.bind(this, item.id, 2)} 
                                            />
                                        :
                                            <ReactPlayer
                                                className='imageinterviewitem'
                                                url={BaseUrl +'storage/'+ item.video}
                                                controls
                                            />
                                    }
                                    <div>
                                        <p><span className='countrystyle'>{item.country}</span> <Icon.Dot/> 
                                        <span> {Moment(item.created_at).fromNow()}</span> <Icon.Dot/> 
                                        <span> {item.category}</span> </p>
                                    </div>
                                    
                                    <div className='titleproject'>
                                        <a href='#' onClick={this._redirectDetail.bind(this, item.id, 2)}>{item.title.substring(0, 50)}...</a>
                                    </div>
                                </div>
                            )
                        :
                            <div className='emptysidebar'>
                                <p>Aucun interview disponible!</p>
                            </div>
                    }

                    <div className='blockbtnallproject'>
                        <a href='#' className='btn  btn-lg allprojectbtn' onClick={this._redirectListInterview}>Voir plus</a>
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
        allinterview: state.dataManager.homedata.allinterview,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(RightBarInterview);
