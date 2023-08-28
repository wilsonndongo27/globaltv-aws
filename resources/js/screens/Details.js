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

class Details extends Component {
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
            comments, 
            likes, 
            connexes, 
            _toggleDetail, 
            _ListViewDataCore,
            detailpagekey,
        } = this.props;
        return (
            <div>
                {
                    detail_view ?
                        <div className='blockdetail'>
                            <span><span className='countrystyle'>{detail_view.country}</span> <Icon.Dot/> 
                            <span> {Moment(detail_view.created_at).fromNow()}</span>  <Icon.Dot/> 
                            <span> {detail_view.category}</span> </span>
                            <h4>{detail_view.title}</h4> 
                            {
                                detail_view.is_video == 0 ?
                                    <img src={BaseUrl +'/storage/'+ detail_view.cover} className='imagedetail'/>
                                :
                                    <video className='imagedetail' controls controlsList='nodownload'>
                                        <source src={BaseUrl +'/storage/'+ detail_view.video} type="video/mp4"/>
                                    </video>
                            }
                            <p className='descriptionarticle' aria-readonly={true}>
                                {Parser(detail_view.description)}
                            </p>
                            <div className='footerdetail'>
                                <div className='col-lg-9'><Icon.ArrowLeftCircle onClick={toggleHome} /><span className='backtext'>Retour</span></div>
                                <div className='col-lg-1'><Icon.ShareFill /><span className='numberitem'>0</span> </div>
                                {/* <div className='col-lg-1'><Icon.Heart /><span className='numberitem'>{likes.length}</span> </div>
                                <div className='col-lg-1'><Icon.Chat onClick={this._toggleCommentBlock} /><span className='numberitem'>{comments.length}</span> </div> */}
                            </div>
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
                            <div className='blockconnexe'>
                                <h4>Sujets connexes</h4>
                                <div className='connexeitemblock row'>
                                    {
                                        connexes ?
                                            connexes.map((item, i) =>
                                                <div className='connexeitem col-lg-6' key={i}> 
                                                    {
                                                        item.is_video == 0 ?
                                                            <img src={BaseUrl +'/storage/'+ item.image} className='imageconnexe'/>
                                                        :
                                                            <video className='imageconnexe' controls controlsList='nodownload'>
                                                                <source src={BaseUrl +'/storage/'+ item.video} type="video/mp4"/>
                                                            </video>
                                                    }                 
                                                    <span><span className='countrystyle'>{item.country}</span> 
                                                    <span> {Moment(item.created_at).fromNow()}</span>  <Icon.Dot/> 
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
                                <a href='#' className='btn btnmoreconnexe' onClick={_ListViewDataCore.bind(this, null, detailpagekey)}>Voir plus</a>
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

export default connect(mapStateToProps, mapDispatchToProps, null)(Details);
