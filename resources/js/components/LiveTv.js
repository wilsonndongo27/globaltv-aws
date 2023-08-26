import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import * as Icon from 'react-bootstrap-icons';
import FadeIn from 'react-fade-in';
import {LiveSwicht} from '../reducers/actions';


class LiveTV extends Component {
    constructor(props){
        super(props);
        this.state = {
            cssblocklive:"containerlivehide",
            visibleTitlelife: 'fixlive1textshow',
        }
    }

    _toggleLive = () => {
        const {visibleLive} = this.props;
        LiveSwicht(!visibleLive);
        if(visibleLive){
            this.setState({
                cssblocklive:"containerlivehide",
                visibleTitlelife:"fixlive1textshow"
            });
        }else{
            this.setState({
                cssblocklive:"containerlive",
                visibleTitlelife:"fixlive1texthide"
            });
        }
    }

    render() {
        const {visibleLive} = this.props;
        return (
            <div className={this.state.cssblocklive}>
                {
                    visibleLive ?
                        <FadeIn delay='100' transitionDuration='1000' >
                            <div className="row togglemenu">
                                <div className="col-lg-6 blocklive1">
                                    <div className='row blockliveleft'>
                                        <div className="col-lg-6 livereader">
                                        </div>
                                        <div className='col-lg-6 infosinstant'>
                                            <p>11:55</p>
                                            <h4>Les Oiseaux de mer</h4>
                                            <p className='descriptionlive'>Description du documentaire</p>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-lg-6 blocklive2">
                                    <div className='row blockliveleft'>
                                        <div className="col-lg-6 livereader">
                                        </div>
                                        <div className='col-lg-6 infosinstant'>
                                            <p>14:55</p>
                                            <h4>Les Oiseaux de mer</h4>
                                            <p>Description du documentaire</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </FadeIn>
                       
                    :null
                }
                <div className='row'>
                    <div className='fixlive1'>
                        <p className={this.state.visibleTitlelife}>
                            <Icon.ArrowUpRightCircleFill  className='liveiconupsimple' />
                            <span>11:25</span>
                            Les Oiseaux de Mer Partie 1
                        </p>
                        {
                            this.state.liveVisible ?
                                <Icon.ArrowUpCircle className='iconhidelive' onClick={this._toggleLive}/>
                            :
                                <Icon.ArrowDownCircle className='iconhidelive' onClick={this._toggleLive}/>

                        }
                    </div>
                    <div className='fixlive2'>
                        <p className={this.state.visibleTitlelife}>
                            <span>11:25</span>
                            Les Oiseaux de Mer Partie 2
                        </p>
                    </div>
                </div>
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        ...bindActionCreators({LiveSwicht}, dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
        visibleLive:state.navigation.visibleLive,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(LiveTV);
