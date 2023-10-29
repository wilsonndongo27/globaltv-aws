import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import Admin from '../assets/img/avatar.png';
import * as Icon from 'react-bootstrap-icons';
import FadeIn from 'react-fade-in';
import {BaseUrl} from '../api/config';
import {detailViewAction} from '../reducers/actions'
import Moment from 'moment';
import 'moment/locale/fr';
import $ from 'jquery';
import Parser from 'html-react-parser';
import LeftBarTopNews from './LeftBarTopNews';
import RightBarInterview from './RightBarInterview';
import  secureLocalStorage  from  "react-secure-storage";
import ReactPlayer from 'react-player'

class Details extends Component {
    constructor(props){
        super(props);
        this.state = {
            visibleComment:false,
        }
    }

    componentDidMount () {
        $('.ql-editor').attr('contenteditable', false);
    }

    _toggleCommentBlock = () => {
        this.setState({
            visibleComment:!this.state.visibleComment,
        });
    }

    _redirectDetail = async (id, key) => {
        const data = {
            'id':id,
            'key':key
        };
        await secureLocalStorage.setItem('detailkey', JSON.stringify(data));
        window.location.replace(BaseUrl + 'detail/'+id+'/')
    }

    _redirectList = async (key) => {
        const data = {
            'key':key
        };
        await secureLocalStorage.setItem('listkey', JSON.stringify(data));
        window.location.replace(BaseUrl + 'list/');
    }

    _redirectHome = () => {
        window.location.replace(BaseUrl + '/');
    }

    render () {
        const {detail_view, detailkey, livePlaying} = this.props;
        return (
            <div className='container'>
                <div className='row bodyitemblock'>
                    {/* Block Top News */}
                    <div className='col-lg-3'>
                        <LeftBarTopNews />
                    </div>

                    {/* Block Detail */}
                    <div className='col-lg-6'>
                        {
                            Object.keys(detail_view).length > 0 ?
                                <div className='blockdetail' id='detailblock'>
                                    <span><span className='countrystyle'>{detail_view.country}</span> <Icon.Dot/> 
                                    <span> Publier, {Moment(detail_view.created_at).fromNow()}</span>  <Icon.Dot/> 
                                    <span> {detail_view.category}</span> </span>
                                    <h4>{detail_view.title}</h4> 
                                    {
                                        detail_view.is_video == 0 ?
                                            <img src={BaseUrl +'storage/'+ detail_view.cover} className='imagedetail'/>
                                        :
                                            <ReactPlayer
                                                className='imagedetail'
                                                url={BaseUrl +'storage/'+ detail_view.video}
                                                controls
                                                playing={!livePlaying}
                                                muted={true}
                                            />
                                    }
                                    <p className='descriptionarticle' aria-readonly={true}>
                                        {Parser(detail_view.description)}
                                    </p>

                                    <div className='footerdetail'>
                                        <div className='col-lg-9 btnbackhome' onClick={this._redirectHome}><Icon.House /><span className='backtext'>Accueil</span></div>
                                        <div className='col-lg-1'><Icon.ShareFill /><span className='numberitem'>0</span> </div>
                                        <div className='col-lg-1'><Icon.HandThumbsUp /><span className='numberitem'>{detail_view.count_like}</span> </div>
                                        <div className='col-lg-1'><Icon.Chat onClick={this._toggleCommentBlock} /><span className='numberitem'>0</span> </div>
                                    </div>

                                    <div>
                                        <div className='blocklistcomment'>
                                            <h4 className='titlecomment'>Commentaires</h4>
                                            {
                                                this.state.visibleComment ?
                                                    <FadeIn delay='100' transitionDuration='1000' >
                                                        <div className='commentitem row'>
                                                            <img src={Admin} className='avatar col-lg-3' />
                                                            <div className='contentcomment col-lg-9'>
                                                                <h4>Wilson</h4>
                                                                <p>ceci est un commentaire</p>
                                                                <span>Il y a 2 jours à</span><span> 11:12</span>
                                                            </div>
                                                        </div>
                                                        <hr className='separatorcomment'/>
                                                        <div className='commentitem row'>
                                                            <img src={Admin} className='avatar col-lg-3' />
                                                            <div className='contentcomment col-lg-9'>
                                                                <h4>Wilson</h4>
                                                                <p>ceci est un commentaire Pour illustrer un test</p>
                                                                <span>Il y a 2 jours à</span><span> 11:12</span>
                                                            </div>
                                                        </div>
                                                    </FadeIn>
                                                :null

                                            }
                                        </div>
                                        <div className='blockcomment'>
                                            <textarea placeholder='Votre commenttaire' className='commentinput'></textarea>
                                            <button className='btn btncomment'>Commenter<Icon.Send/></button>
                                        </div>
                                    </div>

                                    <div className='blockconnexe'>
                                        <h4>Sujets connexes</h4>
                                        <div className='connexeitemblock row'>
                                            {
                                                detail_view.connexes.length > 0 ?
                                                    detail_view.connexes.map((item, i) =>
                                                        <div className='connexeitem col-lg-6' key={i}> 
                                                            {
                                                                item.is_video == 0 ?
                                                                    <img src={BaseUrl +'storage/'+ item.cover} className='imageconnexe'/>
                                                                :
                                                                    <video className='imageconnexe' controls controlsList='nodownload'>
                                                                        <source src={BaseUrl +'storage/'+ item.video} type="video/mp4"/>
                                                                    </video>
                                                            }                 
                                                            <span><span className='countrystyle'>{item.country}</span> 
                                                            <span> Publier, {Moment(item.created_at).fromNow()}</span>  <Icon.Dot/> 
                                                            <span> {item.category}</span> </span>
                                                            <div className='connexetitle'>
                                                                <a href='#' onClick={this._redirectDetail.bind(this, item.id, detailkey)}>{item.title.substring(0, 70)}...</a>
                                                            </div>
                                                        </div>
                                                    )
                                                :
                                                    <div className='connexeitem'>  
                                                        <p>Aucun sujet connexe</p>
                                                    </div>
                                            }
                                        </div>
                                        {
                                            detail_view.connexes.length > 0 ?
                                                <a href='#' className='btn btnmoreconnexe' onClick={this._redirectList.bind(this, detailkey)}>Voir plus</a>
                                            :null
                                        }
                                    </div>
                                </div>
                            :null
                        }
                    </div>

                    {/* Block Interview */}
                    <div className='col-lg-3'>
                        <RightBarInterview />
                    </div>
                </div>
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
   return {
      ...bindActionCreators({detailViewAction}, dispatch),
    }
};

const mapStateToProps = (state) => {
   return {
        detail_view: state.dataManager.detail_view,
        livePlaying:state.navigation.livePlaying,
   }
 }

export default connect(mapStateToProps, mapDispatchToProps, null)(Details);
