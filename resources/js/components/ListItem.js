import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';
import * as Icon from 'react-bootstrap-icons';
import {BaseUrl} from '../api/config';
import Moment from 'moment';
import 'moment/locale/fr';
import  secureLocalStorage  from  "react-secure-storage";

class ListItem extends Component {
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

    _padTo2Digits = (num) => {
        return num.toString().padStart(2, '0');
    }

    render() {
        const {item, key, listkey} = this.props;
        return (
                <div className='itemlist col-lg-3' key={key}>
                    <div className='card'>
                        {
                            !item.video ?
                                <img src={BaseUrl +'storage/'+ item.cover} className='imagelist' />
                            :
                                <video className='imagelist' controls controlsList="nodownload">
                                    <source src={BaseUrl +'storage/'+ item.video} type="video/mp4"/>
                                </video>
                        }
                        {
                            listkey == 5 ?
                                <audio controls className='audioplayer'>
                                    <source src={BaseUrl +'storage/'+ item.audio} />
                                </audio>
                            :null
                        }
                        <div className='footerlist'>
                            <div className='listtitle'>
                                <a href='#' onClick={this._redirectDetail.bind(this, item.id, listkey)}>
                                    {item.title.length > 50 ?
                                        `${item.title.substring(0, 50)}...` : item.title
                                    }
                                </a>
                            </div>
                           
                            <div className='footerlisttime'>
                                <div>{item.country}</div> <Icon.Dot/>
                                <div> Publier, {Moment(item.created_at).fromNow()}</div>
                            </div>
                        </div>
                    </div>
                </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
       ...bindActionCreators(dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
        ...state,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(ListItem);
