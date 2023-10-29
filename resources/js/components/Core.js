import React, { Component, useState  } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import Blogger from '../assets/img/blogger.jpg';
import Podcast from '../assets/img/podcast.jpg';
import * as Icon from 'react-bootstrap-icons';
import DetailHome from './DetailHome';
import {BaseUrl} from '../api/config';
import {ListSwicht, listViewAction, detailHomeViewAction, DetailSwicht} from '../reducers/actions'
import Moment from 'moment';
import 'moment/locale/fr';
import "react-responsive-carousel/lib/styles/carousel.min.css";
import { Carousel } from 'react-responsive-carousel';
import FadeInOut from '../utils/FadeInOut';
import { Swiper, SwiperSlide } from 'swiper/react';
import 'swiper/css';
import ProgramItem from './ProgramItem';
import LeftBarReplay from './LeftBarReplay';
import  secureLocalStorage  from  "react-secure-storage";
import RightBarPodcast from './RightBarPodcast';

class Core extends Component {
    constructor(props){
        super(props);
        this.state = {
            visibleDetail:false,
        }
    }

    _backHome = () => {
        const {visibleDetail} = this.props;
        if(visibleDetail == true){
            DetailSwicht(!visibleDetail);
        }
        window.scrollTo(0, 0);
    }

    _toggleDetail = (item, key) => {
        const {visibleDetail} = this.props;
        if(!visibleDetail == true){
            DetailSwicht(!visibleDetail);
        }
        const data = {
            'item':item,
            'key':key
        };
        detailHomeViewAction(data);
    }

    _redirectList = async (key) => {
        const data = {
            'key':key
        };
        await secureLocalStorage.setItem('listkey', JSON.stringify(data));
        window.location.assign('/list');
    }

    _redirectInterviewList = async (key) => {
        const data = {
            'key':2
        };
        await secureLocalStorage.setItem('listkey', JSON.stringify(data));
        window.location.assign('/list');
    }

    _padTo2Digits = (num) => {
        return num.toString().padStart(2, '0');
    }

    _redirectBanner = (item) => {
        console.log(item)
    }

    _nextTopNews = () => {
        console.log('Next Element')
    }

    _previousTopNews = () => {
        console.log('Previows element')
    }

    render() {
        const {is_loading, 
            allnews, 
            allinterview, 
            visibleDetail, 
            detailpagekey,
            allpodcast,
            allreplay,
            allbanner,
            alltopnews,
        } = this.props;
        return (
            <div className='container'>
                <div className='row bodyitemblock'>
                    {/* Block Replay */}
                    <div className='col-lg-3'>
                        <LeftBarReplay 
                            allreplay={allreplay} 
                        />
                    </div>

                    {/* Bock Pub et To News */}
                    <div className='col-lg-6'>
                        {
                            !visibleDetail ?
                                <div className='bannerblock'>
                                    {
                                        allbanner ?
                                            <Carousel autoPlay infiniteLoop>
                                                {
                                                    allbanner.map((item, i) => 
                                                        <div key={i} onClick={this._redirectBanner.bind(this, item)}>
                                                            <img className='bannerimage' src={BaseUrl + 'storage/' + item.cover} />
                                                        </div>
                                                    )
                                                }
                                            </Carousel>       
                                        :null
                                    }
                                </div>
                            :null
                        }
                     
                        <div>
                            {
                                visibleDetail ?
                                    <DetailHome 
                                        toggleHome={this._backHome} 
                                        _toggleDetail={this._toggleDetail}
                                        detailpagekey={detailpagekey}
                                        _redirectList={this._redirectList}
                                    />
                                :
                                    <div className='blocknewshome'>
                                        <h4 className='titlecore'>A la Une </h4>
                                        <div className='card bodyblock2'>
                                            <div className='bannercss'>
                                                <Swiper
                                                    spaceBetween={50}
                                                    slidesPerView={1}
                                                    onSlideChange={() => console.log('slide change')}
                                                    onSwiper={(swiper) => console.log(swiper)}
                                                    >
                                                        {
                                                            alltopnews ?
                                                                alltopnews.map((item, i) => 
                                                                    <FadeInOut show={true} duration={3000} key={i}>
                                                                        <SwiperSlide>
                                                                            <img src={ BaseUrl + 'storage/' + item.cover } className='imagebanner' />
                                                                            <div className='timeblockbanner'>
                                                                                <p><span className='countrystyle'>{item.country}</span> 
                                                                                <span><Icon.Dot/> {Moment(item.created_at).fromNow()}</span> 
                                                                                <span><Icon.Dot/> {item.category}</span> </p>
                                                                            </div>
                                                                            <div className='titlebanner'>
                                                                                <p onClick={this._toggleDetail.bind(this, item, 1)}>{item.title}</p>
                                                                            </div>
                                                                        </SwiperSlide>
                                                                    </FadeInOut>
                                                                )
                                                            
                                                            :null
                                                        }
                                                </Swiper>
                                                <div className='blockarrowtopnews'>
                                                    <Icon.ArrowLeftCircle className='iconchangeleftinfo swiper-slide-prev' 
                                                    onClick={this._nextTopNews}/>
                                                    <Icon.ArrowRightCircle className='iconchangerightinfo swiper-slide-next' 
                                                    onClick={this._previousTopNews}/>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div className='newslist'>
                                                <ul>
                                                    {
                                                        allnews ?
                                                            allnews.map((item, i) => 
                                                                <div key={i}>
                                                                    <li>
                                                                        <p><span className='countrystyle'>{item.country}</span> <Icon.Dot/> 
                                                                        <span> {Moment(item.created_at).fromNow()}</span> <Icon.Dot/> 
                                                                        <span> {item.category}</span> </p>
                                                                        <a href='#' onClick={this._toggleDetail.bind(this, item, 1)}>{item.title}</a>
                                                                    </li>
                                                                    <hr/>
                                                                </div>
                                                            )
                                                        :null
                                                    }
                                                </ul>
                                                <div className='blockbtnallactu'>
                                                    <a href='#' className='btn  btn-lg allactubtn' onClick={this._redirectList.bind(this, 1)}>Toute l'Actualités</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                }
                              
                        </div>
 
                        <div className='interviewsblock'>
                            <div className='bloggerblock'>
                                <img src={Blogger} className='imageblogger'/>
                            </div>
                            <div className='interviewblock'>
                                <div className='interviewheaderblock'>
                                    <h4>Interviews </h4>
                                    <div className='categorieinterview'>
                                        <ul>
                                            {
                                                allinterview ?
                                                    allinterview.map((item, i) => 
                                                        <li key={i}><a href='#'>{item.category}</a></li>
                                                    )
                                                :null

                                            }
                                        </ul>
                                    </div>
                                </div>
                                <div className='listinterviewcontainer'>
                                    <ul>
                                        {
                                            allinterview ?
                                                allinterview.map((item, i) => 
                                                    <li key={i}>
                                                        <div className='blockimageinterviewitem'>
                                                            {
                                                                item.is_video == 0 ?
                                                                    <img src={BaseUrl +'storage/'+ item.cover} className='imageinterviewitem'
                                                                        onClick={this._toggleDetail.bind(this, item, 2)} 
                                                                    />
                                                                :
                                                                    <video className='imageinterviewitem' controls controlsList="nodownload"
                                                                        onClick={this._toggleDetail.bind(this, item, 2)}>
                                                                        <source src={BaseUrl +'storage/'+ item.video} type="video/mp4"/>
                                                                    </video>
                                                            }
                                                        </div>
                                                        <div className='col-lg-6 detailinterview'>
                                                            <p><span className='countrystyle'>{item.country}</span> <Icon.Dot/> 
                                                            <span> {Moment(item.created_at).fromNow()}</span> <Icon.Dot/> 
                                                            <span> {item.categorie}</span> </p>
                                                            <a href='#' onClick={this._toggleDetail.bind(this, item, 2)} >{item.title}</a>
                                                        </div>
                                                    </li>
                                                )
                                            :null
                                        }
                                    </ul>
                                </div>
                                <div className='blockbtnallinterview'>
                                    <button className='btn btn-lg allinterviewbtn' onClick={this._redirectInterviewList}>Tous les Interviews</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {/* Block PodCasts */}
                    <div className='col-lg-3'>
                        <RightBarPodcast
                            allpodcast={allpodcast}
                        />
                    </div>
                </div>
               
                <ProgramItem />

                <div className='podcastblock container'>
                    <img src={Podcast} className='imagepodcast'/>
                </div>
                {/* 
                <div className='blockworlddigital'>
                    <div className='blockheadworlddigital'>
                        <h4>
                            <Icon.PlayCircle />
                            <span>Le monde digital</span>
                        </h4>
                        <div className='blockchangeslideworlddigital'>
                            <Icon.ArrowLeftCircle className='iconchangeleftworlddigital'/>
                            <Icon.ArrowRightCircle className='iconchangerightworlddigital'/>
                        </div>
                    </div>
                    <div className='blockwolddigitaltv'>
                        <div className='row '>
                            <div className='col-lg-4 itemwolddigital'>
                                <div className='card'>
                                    <img src={Worlddigital} className='imagewolddigitaltv'/>
                                    <div className='footeritemdigitalworld'>
                                        <a href='#'>75th Anniverssaire...</a>
                                        <p>
                                            <span className='countrystyle'>CAmeroun</span> 
                                            <span><Icon.Dot/> Sport</span> 
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div className='col-lg-4 itemwolddigital'>
                                <div className='card'>
                                    <img src={Worlddigital} className='imagewolddigitaltv'/>
                                    <div className='footeritemdigitalworld'>
                                        <a href='#'>75th Anniverssaire...</a>
                                        <p>
                                            <span><ReactCountryFlag countryCode="FR" svg /> <Icon.Dot/> France</span>
                                            <span><Icon.Dot/> Sport</span> 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 */}
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
       ...bindActionCreators({listViewAction, ListSwicht, detailHomeViewAction, DetailSwicht}, dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
        detailpagekey: state.navigation.detailpagekey,
        listpagekey: state.navigation.listpagekey,
        is_loading: state.loading.is_loading,
        visibleList:state.navigation.visibleList,
        visibleDetail:state.navigation.visibleDetail,
        allnews: state.dataManager.homedata.allnews,
        allinterview: state.dataManager.homedata.allinterview,
        allprogram: state.dataManager.homedata.allprogram,
        allpodcast:state.dataManager.homedata.allpodcast,
        allreplay:state.dataManager.homedata.allreplay,
        allbanner:state.dataManager.homedata.allbanner,
        alltopnews: state.dataManager.homedata.alltopnews,
        details: state.dataManager.detail_view,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(Core);
