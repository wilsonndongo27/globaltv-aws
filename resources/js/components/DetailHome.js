import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import Admin from '../assets/img/avatar.png';
import ReactCountryFlag from "react-country-flag"
import * as Icon from 'react-bootstrap-icons';
import FadeIn from 'react-fade-in';
import {BaseUrl} from '../api/config';
import {detailViewAction, DetailSwicht} from '../reducers/actions'
import Moment from 'moment';
import 'moment/locale/fr';
import $ from 'jquery';
import Parser from 'html-react-parser';

class DetailHome extends Component {
    constructor(props){
        super(props);
        this.state = {
            visibleComment:false,
        }
    }

    componentDidMount () {
        $('.ql-editor').attr('contenteditable', false);
        $('.ql-hidden').css('display', 'none');
    }

    _toggleCommentBlock = () => {
        this.setState({
            visibleComment:!this.state.visibleComment,
        });
    }

    render () {
        const {toggleHome, 
            detail_view, 
            _toggleDetail, 
            _redirectList,
            detailpagekey,
        } = this.props;
        return (
            <div>
                {
                    Object.keys(detail_view).length > 0 ?
                        <div className='blockdetail' id='detailblock'>
                            <span><span className='countrystyle'>{detail_view.country}</span> <Icon.Dot/> 
                            <span> {Moment(detail_view.created_at).fromNow()}</span>  <Icon.Dot/> 
                            <span> {detail_view.category}</span> </span>
                            <h4>{detail_view.title}</h4> 
                            {
                                detail_view.is_video == 0 ?
                                    <img src={BaseUrl +'storage/'+ detail_view.cover} className='imagedetail'/>
                                :
                                    <video className='imagedetail' controls controlsList='nodownload'>
                                        <source src={BaseUrl +'storage/'+ detail_view.video} type="video/mp4"/>
                                    </video>
                            }
                            <p className='descriptionarticle' aria-readonly={true}>
                                {Parser(detail_view.description)}
                            </p>
                            <div className='footerdetail'>
                                <div className='col-lg-9 btnbackhome' onClick={toggleHome}><Icon.House /><span className='backtext'>Accueil</span></div>
                                <div className='col-lg-1'><Icon.ShareFill /><span className='numberitem'>0</span> </div>
                                <div className='col-lg-1'><Icon.HandThumbsUp /><span className='numberitem'>{detail_view.count_like}</span> </div>
                                <div className='col-lg-1'><Icon.Chat onClick={this._toggleCommentBlock} /><span className='numberitem'>0</span> </div>
                            </div>

                            {/* Block Comments */}
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

                            {/* Block Connexes */}
                            <div className='blockconnexe'>
                                <h4>Sujets connexes</h4>
                                <div className='connexeitemblock row'>
                                    {
                                        detail_view.connexes.lenght > 0 ?
                                            detail_view.connexes.map((item, i) =>
                                                <div className='connexeitem col-lg-6' key={i}> 
                                                    {
                                                        item.is_video == 0 ?
                                                            <img src={BaseUrl +'storage/'+ item.image} className='imageconnexe'/>
                                                        :
                                                            <video className='imageconnexe' controls controlsList='nodownload'>
                                                                <source src={BaseUrl +'storage/'+ item.video} type="video/mp4"/>
                                                            </video>
                                                    }                 
                                                    <span><span className='countrystyle'>{item.country}</span> 
                                                    <span>Publier, {Moment(item.created_at).fromNow()}</span>  <Icon.Dot/> 
                                                    <span> {item.category}</span> </span>
                                                    <div className='connexetitle'>
                                                        <a href='#' onClick={_toggleDetail.bind(this, item, detailpagekey)}>{item.title}</a>
                                                    </div>
                                                </div>
                                            )
                                        :
                                            <div className='connexeitem'>  
                                                <p>Aucun sujet connexe</p>
                                            </div>
                                    }
                                </div>
                                <a href='#' className='btn btnmoreconnexe' onClick={_redirectList.bind(this, detailpagekey)}>Voir plus</a>
                            </div>
                        </div>
                    :null
                }
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
   return {
      ...bindActionCreators({detailViewAction, DetailSwicht}, dispatch),
    }
};

const mapStateToProps = (state) => {
   return {
        detail_view: state.dataManager.detail_view,
        comments: state.dataManager.detail_view.comments,
        likes: state.dataManager.detail_view.likes,
        connexes: state.dataManager.detail_view.connexes,
   }
 }

export default connect(mapStateToProps, mapDispatchToProps, null)(DetailHome);
