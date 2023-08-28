import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';
import ReactCountryFlag from "react-country-flag"
import * as Icon from 'react-bootstrap-icons';
import {BaseUrl} from '../api/config';
import {detailViewAction, DetailSwicht, ListSwicht} from '../reducers/actions'
import Moment from 'moment';
import 'moment/locale/fr';

class ListItem extends Component {
    constructor(props){
        super(props);
        this.state = {
        }
    }

    _toggleDetail = (item, key) => {
        const {visibleDetail, visibleList} = this.props;
        if(visibleList == true){
            ListSwicht(false);
        }
        if(!visibleDetail == true){
            DetailSwicht(!visibleDetail);
        }
        const data = {
            'item':item,
            'key':key
        };
        detailViewAction(data);
    }

    _padTo2Digits = (num) => {
        return num.toString().padStart(2, '0');
    }

    render() {
        const {item, key, listpagekey} = this.props;
        return (
                <div className='itemlist col-lg-3' key={key}>
                    <div className='card'>
                        {
                            !item.video ?
                                <img src={BaseUrl +'/storage/'+ item.cover} className='imagelist' />
                            :
                                <video className='imagelist' controls controlsList="nodownload">
                                    <source src={BaseUrl +'/storage/'+ item.video} type="video/mp4"/>
                                </video>
                        }
                        <div className='footerlist'>
                            <div className='listtitle'>
                                <a href='#' onClick={this._toggleDetail.bind(this, item, listpagekey)} >{item.title}</a>
                            </div>
                            {
                                listpagekey == 3 || listpagekey == 4 ?
                                    null
                                :
                                    <div className='footerlisttime'>
                                        <div>{item.country}</div> <Icon.Dot/>
                                        <div> {Moment(item.created_at).fromNow()}</div>
                                    </div>
                            }
                            
                        </div>
                    </div>
                </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
       ...bindActionCreators({detailViewAction, DetailSwicht, ListSwicht}, dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
        visibleList:state.navigation.visibleList,
        visibleDetail:state.navigation.visibleDetail,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(ListItem);
