import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';
import * as Icon from 'react-bootstrap-icons';
import PubImage from '../assets/img/pub.jpg';
import Moment from 'moment';
import 'moment/locale/fr';
import { homeActionData } from '../reducers/actions';
import  secureLocalStorage  from  "react-secure-storage";
import {BaseUrl} from '../api/config';
import { Swiper, SwiperSlide } from 'swiper/react';


class LeftBarTopNews extends Component {
    constructor(props){
        super(props);
        this.state = {
        }
    }

    componentDidMount(){
        this._loadListNews();
    }

    _loadListNews = () => {
        homeActionData();
    }

    _redirectDetail = async (id, key) => {
        const data = {
            'id':id,
            'key':key
        };
        await secureLocalStorage.setItem('detailkey', JSON.stringify(data));
        window.location.replace(BaseUrl + 'detail/'+id+'/');
    }

    _redirectListNews = async () => {
        const data = {
            'key':1
        };
        await secureLocalStorage.setItem('listkey', JSON.stringify(data));
        window.location.replace(BaseUrl + 'list/');
    }
 
    render() {
        const {alltopnews} = this.props;
        return (
            <>
                <h4 className='titlecore'>A la Une </h4>
                    <div className='card bodyblock1'>
                        {
                            alltopnews ?
                                <Swiper
                                    spaceBetween={50}
                                    slidesPerView={1}
                                    onSlideChange={() => console.log('slide change')}
                                    onSwiper={(swiper) => console.log(swiper)}
                                    autoplay={true}
                                    >
                                        {
                                            alltopnews ?
                                                alltopnews.map((item, i) => 
                                                    <SwiperSlide key={i}>
                                                        <img src={ BaseUrl + 'storage/' + item.cover } className='imagebanner' />
                                                        <div className='timeblockbanner'>
                                                            <p><span className='countrystyle'>{item.country}</span> 
                                                            <span><Icon.Dot/>Publier, {Moment(item.created_at).fromNow()}</span> 
                                                            <span><Icon.Dot/> {item.category}</span> </p>
                                                        </div>
                                                        <div className='titlebanner'>
                                                            <p onClick={this._redirectDetail.bind(this, item.id, 1)}>{item.title}</p>
                                                        </div>
                                                    </SwiperSlide>
                                                )
                                            
                                            :null
                                        }
                                </Swiper>
                            :null 
                        }
                        <div className='blockbtnallactulife'>
                            <a href='#' className='btn  btn-lg allactulifebtn' onClick={this._redirectListNews}>Voir plus</a>
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
       ...bindActionCreators({homeActionData}, dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
        alltopnews: state.dataManager.homedata.alltopnews,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(LeftBarTopNews);
