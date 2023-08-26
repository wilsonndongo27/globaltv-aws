import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import Banner1 from '../assets/img/banner1.jpg';
import Blogger from '../assets/img/blogger.jpg';
import Podcast from '../assets/img/podcast.jpg';
import ActuImage from '../assets/img/actu.jpg';
import Worlddigital from '../assets/img/wolddigital.jpg';
import PubImage from '../assets/img/pub.jpg';
import * as Icon from 'react-bootstrap-icons';
import ReactCountryFlag from "react-country-flag"
import Details from '../screens/Details';
import {BaseUrl} from '../api/config';
import {ListSwicht, listViewAction, detailViewAction, DetailSwicht} from '../reducers/actions'

class Core extends Component {
    constructor(props){
        super(props);
        this.state = {
            visibleDetail:false,
        }
    }

    componentDidMount(){
        
    }

    _backHome = () => {
        const {visibleDetail} = this.props;
        if(visibleDetail == true){
            DetailSwicht(!visibleDetail);
        }
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
        detailViewAction(data);
    }

    _ListViewDataCore = (item, key) => {
        const {visibleList} = this.props;
        ListSwicht(!visibleList);
        const data = {
            'item':item,
            'key':key
        };
        listViewAction(data);
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
        const {is_loading, 
            allnews, 
            allinterviews, 
            allprogrammes, 
            allcategories, 
            details, 
            visibleDetail, 
            detailpagekey,
            listpagekey
        } = this.props;
        return (
            <div className='container'>
                <div className='row bodyitemblock'>
                    <div className='col-lg-3'>
                        <h4 className='titlecore'>Actualités </h4>
                        <div className='card bodyblock1'>
                            {
                                allnews ?
                                    allnews.map((news, i) => 
                                        news.categorie == 2 ?
                                            <div className='actuitem' key={i}>
                                                {
                                                    news.is_video == 0 ?
                                                        <img src={BaseUrl +'/storage/'+ news.image} className='imageactu'  onClick={this._toggleDetail.bind(this, news.id, 1)} />
                                                    :
                                                        <video className='imageactu' controls controlsList="nodownload"  onClick={this._toggleDetail.bind(this, news.id, 1)}>
                                                            <source src={BaseUrl +'/storage/'+ news.video} type="video/mp4"/>
                                                        </video>
                                                }
                                                <div className='timeactu'>
                                                    <p>
                                                        <span><ReactCountryFlag countryCode={this._getCountry(news.origine)} svg /></span> 
                                                        <span> {this._formatDate(new Date(news.created_at))}</span>
                                                        <span><Icon.Dot/> {this._formatHour(new Date(news.created_at))}</span> 
                                                        <span><Icon.Dot/> {this._getCategorie(news.categorie)}</span> 
                                                    </p>
                                                </div>
                                                <div className='titleactu'>
                                                    <a href='#' onClick={this._toggleDetail.bind(this, news.id, 1)}>{news.title}</a>
                                                </div>
                                            </div>
                                        :null
                                    )   
                                :null 
                            }
                            <div className='blockbtnallactulife'>
                                <a href='#' className='btn  btn-lg allactulifebtn' onClick={this._ListViewDataCore.bind(this, null, 1)}>Voir plus</a>
                            </div>
                        </div>
                        <div className='card blockpub'>
                            <img src={PubImage} className='imagepub'/>
                        </div>
                    </div>

                    {
                        visibleDetail ?
                            <div className='col-lg-6'>
                                <Details 
                                    toggleHome={this._backHome} 
                                    _toggleDetail={this._toggleDetail}
                                    _ListViewDataCore={this._ListViewDataCore}
                                    _formatDate={this._formatDate}
                                    _formatHour={this._formatHour}
                                    _getCountry={this._getCountry}
                                    _getCategorie={this._getCategorie}
                                    detailpagekey={detailpagekey}
                                />
                            </div>
                        :
                            <div className='col-lg-6'>
                                <h4 className='titlecore'>Accueil </h4>
                                <div className='card bodyblock2'>
                                    <div className='bannercss'>
                                        <img src={Banner1} className='imagebanner' />
                                        <div className='timeblockbanner'>
                                            <p><span><ReactCountryFlag countryCode="CM" svg /></span> 
                                            <span>01.01.2000</span> 
                                            <span>11.22</span> 
                                            <span>Sport</span> </p>
                                            <div className='blockslidebtninfo'>
                                                <Icon.ArrowLeftCircle className='iconchangeleftinfo'/>
                                                <Icon.ArrowRightCircle className='iconchangerightinfo'/>
                                            </div>
                                        </div>
                                        <div className='titlebanner'>
                                            <p onClick={this._toggleDetail}>Nouveau stade de football à Bafoussam</p>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div className='newslist'>
                                        <ul>
                                            {
                                                allnews ?
                                                    allnews.map((news, i) => 
                                                        <div key={i}>
                                                            <li>
                                                                <p><span><ReactCountryFlag countryCode={this._getCountry(news.origine)} svg /></span> 
                                                                <span> {this._formatDate(new Date(news.created_at))}</span> 
                                                                <span> {this._formatHour(new Date(news.created_at))}</span> 
                                                                <span> {this._getCategorie(news.categorie)}</span> </p>
                                                                <a href='#' onClick={this._toggleDetail.bind(this, news.id, 1)}>{news.title}</a>
                                                            </li>
                                                            <hr/>
                                                        </div>
                                                    )
                                                :null
                                            }
                                        </ul>
                                        <div className='blockbtnallactu'>
                                            <a href='#' className='btn  btn-lg allactubtn' onClick={this._ListViewDataCore.bind(this,null, 1)}>Toute l'Actualités</a>
                                        </div>
                                    </div>
                                </div>
                                <div className='bloggerblock'>
                                    <img src={Blogger} className='imageblogger'/>
                                </div>
                                <div className='interviewblock'>
                                    <div className='interviewheaderblock'>
                                        <h4>Interviews </h4>
                                        <div className='categorieinterview'>
                                            <ul>
                                                {
                                                    allcategories ?
                                                        allcategories.map((categorie, i) => 
                                                            <li key={i}><a href='#'>{categorie.title}</a></li>
                                                        )
                                                    :null

                                                }
                                            </ul>
                                        </div>
                                    </div>
                                    <div className='listinterviewcontainer'>
                                        <ul>
                                            {
                                                allinterviews ?
                                                    allinterviews.map((interview, i) => 
                                                        <li key={i}>
                                                            <div className='blockimageinterviewitem'>
                                                                {
                                                                    interview.is_video == 0 ?
                                                                        <img src={BaseUrl +'/storage/'+ interview.image} className='imageinterviewitem'
                                                                            onClick={this._toggleDetail.bind(this, interview.id, 2)} 
                                                                        />
                                                                    :
                                                                        <video className='imageinterviewitem' controls controlsList="nodownload"
                                                                            onClick={this._toggleDetail.bind(this, interview.id, 2)}
                                                                        >
                                                                            <source src={BaseUrl +'/storage/'+ interview.video} type="video/mp4"/>
                                                                        </video>
                                                                }
                                                            </div>
                                                            <div className='col-lg-6 detailinterview'>
                                                                <p><span><ReactCountryFlag countryCode={this._getCountry(interview.origine)} svg />
                                                                </span> <span> {this._formatDate(new Date(interview.created_at))}</span> 
                                                                <span> {this._formatHour(new Date(interview.created_at))}</span> 
                                                                <span> {this._getCategorie(interview.categorie)}</span> </p>
                                                                <a href='#' onClick={this._toggleDetail.bind(this, interview.id, 2)} >{interview.title}</a>
                                                            </div>
                                                        </li>
                                                    )
                                                :null
                                            }
                                        </ul>
                                    </div>
                                    <div className='blockbtnallinterview'>
                                        <button className='btn btn-lg allinterviewbtn'>Tous les Interviews</button>
                                    </div>
                                </div>
                            </div>
                    }

                    <div className='col-lg-3'>
                        <h4 className='titlecore'>Projets {this.state.visibleDetail} </h4>
                        <div className='card bodyblock3'>
                            {
                                allnews ?
                                    allnews.map((news, i) => 
                                        news.categorie == 3 ?
                                            <div className='projectitem' key={i}>
                                                <img src={BaseUrl +'/storage/'+ news.image} className='imageproject'/>
                                                <div className='timeproject'>
                                                    <p>
                                                        <span><ReactCountryFlag countryCode={this._getCountry(news.origine)} svg /></span> 
                                                        <span> {this._formatDate(new Date(news.created_at))}</span> 
                                                        <span> <Icon.Dot/> {this._formatHour(new Date(news.created_at))}</span> 
                                                        <span><Icon.Dot/> {this._getCategorie(news.categorie)}</span> 
                                                    </p>
                                                </div>
                                                <div className='titleproject'>
                                                    <a href='#' onClick={this._toggleDetail.bind(this, news.id, 1)}>{news.title}</a>
                                                </div>
                                            </div>
                                        :null
                                    )
                                :null
                            }

                            <div className='blockbtnallproject'>
                                <a href='#' className='btn  btn-lg allprojectbtn' onClick={this._ListViewDataCore.bind(this, null, 1)}>Voir plus</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div className='tvprogramblock container'>
                    <div className='hearderblockprogramtv'> 
                        <h4>Programme TV</h4>
                        <a href='#' className='linkallprogram'>
                            Voir Tous <span><Icon.ArrowRightCircle className='iconviewallprogram'/></span>
                        </a>
                    </div>
                    <div className='blockitemprogrammetv'>
                        <div className='row '>
                            {
                                allprogrammes ?
                                    allprogrammes.map((programe, i) => 
                                        <div className='col-lg-4 itemprogram' key={i}>
                                            <div className='card'>
                                                <img src={BaseUrl +'/storage/'+ programe.image} className='imageprogrammetv'/>
                                                <a href='#'>{programe.title}</a>
                                            </div>
                                        </div>
                                    )
                                :null
                            }
                        </div>
                    </div>
                </div>
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
                                            <span><ReactCountryFlag countryCode="CM" svg /> <Icon.Dot/> Cameroun</span>
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
       ...bindActionCreators({listViewAction, ListSwicht, detailViewAction, DetailSwicht}, dispatch),
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
        allinterviews: state.dataManager.homedata.allinterviews,
        allprogrammes: state.dataManager.homedata.allprogrammes,
        allcategories: state.dataManager.homedata.allcategories,
        allpays: state.dataManager.homedata.allpays,
        details: state.dataManager.detail_view,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(Core);
