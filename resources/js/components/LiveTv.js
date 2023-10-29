import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import * as Icon from 'react-bootstrap-icons';
import FadeIn from 'react-fade-in';
import {LivePlayingSwicht, LiveSwicht} from '../reducers/actions';
import FadeInOut from '../utils/FadeInOut';
import ReactPlayer from 'react-player'


class LiveTV extends Component {
    constructor(props){
        super(props);
        this.state = {
            cssblocklive:"containerlivehide",
            visibleTitlelife: 'fixlive1textshow',
        }
    }

    _toggleLive = async () => {
        const {visibleLive, livePlaying} = this.props;
        await LivePlayingSwicht(!livePlaying),
        await LiveSwicht(!visibleLive);
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
        const {visibleLive, livePlaying} = this.props;
        return (
            <div className={this.state.cssblocklive}>
                {
                    visibleLive ?
                        <FadeInOut show={visibleLive} duration={1000} className='blockfade'>
                            <div className="row togglemenu">
                                <div className="col-lg-6 blocklive1">
                                    <div className='row blockliveleft'>
                                        <ReactPlayer
                                            className='col-lg-6 livereader'
                                            url='https://www.youtube.com/watch?v=N241Ffc3EaA&t=145s'
                                            controls
                                            playing={livePlaying}
                                        />
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
                                            <p>Dans 30 min</p>
                                            <h4>Journal de 13h</h4>
                                            <p>Infos à la une (Sommaire Internationnal)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </FadeInOut>
                       
                    :null
                }
                <div className='row'>
                    <div className='fixlive1'>
                        <p className={this.state.visibleTitlelife}>
                            <Icon.ArrowUpRightCircleFill  className='liveiconupsimple' />
                            <span>11:55</span>
                            Les Oiseaux de mer
                        </p>
                        {
                            visibleLive ?
                                <div className='liveiconhideblock'>
                                    <Icon.ArrowUpCircle className='iconhidelive' onClick={this._toggleLive}/>
                                </div>
                            :
                                <div className='liveiconhideblock'>
                                    <Icon.ArrowDownCircle className='iconhidelive' onClick={this._toggleLive}/>
                                </div>
                        }
                    </div>
                    <div className='fixlive2'>
                        <p className={this.state.visibleTitlelife}>
                            <span>Dans 30 min</span>
                            Journal de 13h
                        </p>
                    </div>
                </div>
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        ...bindActionCreators({LiveSwicht, LivePlayingSwicht}, dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
        visibleLive:state.navigation.visibleLive,
        livePlaying:state.navigation.livePlaying,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(LiveTV);
