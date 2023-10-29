import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';
import * as Icon from 'react-bootstrap-icons';
import PubImage from '../assets/img/pub.jpg';
import Moment from 'moment';
import 'moment/locale/fr';
import { listViewAction } from '../reducers/actions';
import  secureLocalStorage  from  "react-secure-storage";
import {BaseUrl} from '../api/config';


class LeftBarReplay extends Component {
    constructor(props){
        super(props);
        this.state = {
        }
    }

    _redirectDetail = async (id, key) => {
        const data = {
            'id':id,
            'key':key
        };
        await secureLocalStorage.setItem('detailkey', JSON.stringify(data));
        window.location.replace(BaseUrl + 'detail/'+id+'/');
    }

    _redirectListReplay = async () => {
        const data = {
            'key':3
        };
        await secureLocalStorage.setItem('listkey', JSON.stringify(data));
        window.location.assign('list/');
    }
 
    render() {
        const {allreplay} = this.props;
        return (
            <>
                <h4 className='titlecore'>Nouveaux Replays </h4>
                    <div className='card bodyblock1'>
                        {
                            allreplay ?
                                allreplay.map((item, i) => 
                                    <div className='actuitem' key={i}>
                                        <video className='imageactu' controls controlsList="nodownload"  onClick={this._redirectDetail.bind(this, item.id, 3)}>
                                            <source src={BaseUrl +'storage/'+ item.video} type="video/mp4"/>
                                        </video>
                                        <div className='timeactu'>
                                            <p>
                                                <span>Publier, {Moment(item.created_at).fromNow()}</span>
                                                <span><Icon.Dot/> {item.program} </span> 
                                            </p>
                                        </div>
                                        <div className='titleactu'>
                                            <a href='#' onClick={this._redirectDetail.bind(this, item.id, 3)}>{item.title}</a>
                                        </div>
                                    </div>
                                )   
                            :null 
                        }
                        <div className='blockbtnallactulife'>
                            <a href='#' className='btn  btn-lg allactulifebtn' onClick={this._redirectListReplay}>Voir plus</a>
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
       ...bindActionCreators({listViewAction}, dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
         ...state
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(LeftBarReplay);
