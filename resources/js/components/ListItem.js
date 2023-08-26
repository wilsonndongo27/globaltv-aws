import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';
import ReactCountryFlag from "react-country-flag"
import {BaseUrl} from '../api/config';
import {detailViewAction, DetailSwicht, ListSwicht} from '../reducers/actions'

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

    _formatDate = (date) => {
        return [
            this._padTo2Digits(date.getDate()),
            this._padTo2Digits(date.getMonth() + 1),
            date.getFullYear(),
        ].join('.');
    }

    _formatHour = (data) => {
        var minute = data.getUTCMinutes();
        var hour = data.getUTCHours();
        if(minute > 0)  
            return hour+"."+minute;
        else
            return hour;
    }

    _getCountry = (data) => {
        const {allpays} = this.props;
        var filteritem = allpays.filter(function (item) {
            if(item.id == data){
                return item;
            }
        });
        return filteritem[0].abreviation;
    }

    _getCategorie = (data) => {
        const {allcategories} = this.props;
        var filteritem = allcategories.filter(function (item) {
            if(item.id == data){
                return item;
            }
        });
        return filteritem[0].title;
    }

    render() {
        const {item, key, listpagekey} = this.props;
        return (
                <div className='itemlist col-lg-3' key={key}>
                    <div className='card'>
                        {
                            !item.video ?
                                <img src={BaseUrl +'/storage/'+ item.image} className='imagelist' />
                            :
                                <video className='imagelist' controls controlsList="nodownload">
                                    <source src={BaseUrl +'/storage/'+ item.video} type="video/mp4"/>
                                </video>
                        }
                        <div className='footerlist'>
                            <div className='listtitle'>
                                <a href='#' onClick={this._toggleDetail.bind(this, item.id, listpagekey)} >{item.title}</a>
                            </div>
                            {
                                listpagekey == 3 || listpagekey == 4 ?
                                    null
                                :
                                    <div className='row'>
                                        <div className='col-lg-2'><ReactCountryFlag countryCode={this._getCountry(item.origine)} svg  /></div>
                                        <div className='col-lg-5'> {this._formatDate(new Date(item.created_at))}</div>
                                        <div className='col-lg-4'> {this._formatHour(new Date(item.created_at))}</div>
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
        allcategories: state.dataManager.homedata.allcategories,
        allpays: state.dataManager.homedata.allpays,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(ListItem);
