import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';
import * as Icon from 'react-bootstrap-icons';


class Footer extends Component {
    constructor(props){
        super(props);
        this.state = {
        }
    }

    render() {
        return (
            <div className='mainblockfooter card'>
                <div className='firstlinefooterblock container'>
                    <div className='col-lg-3'>
                        <h4>Contact</h4>
                        <p><Icon.House /> 127299, Russia, Moscow</p>
                        <p><Icon.Phone /> +XXX XXX XXX XXX</p>
                        <p><Icon.Phone /> wilson@gmail.com</p>
                        <div className='languagefooter'>
                            <p>FR</p>
                            <p>EN</p>
                            <p>ES</p>
                            <p>DE</p>
                        </div>
                    </div>
                    <div className='col-lg-2'>
                        <h4>Programmes TV</h4>
                        <p>Documentaire</p>
                        <p>Cinéma</p>
                        <p>Music</p>
                        <p>Sport</p>
                    </div>
                    <div className='col-lg-2'>
                        <h4>Autres TV</h4>
                        <p>Pays</p>
                        <p>Partenaire</p>
                        <p>Contact</p>
                    </div>
                    <div className='col-lg-2 socialfooter'>
                        <h4>Réseaux sociaux TV</h4>
                        <Icon.Facebook/>
                        <Icon.Twitter/>
                        <Icon.Whatsapp/>
                        <Icon.Telegram/>
                    </div>
                    <div className='col-lg-3 downloadappfooter'>
                        <h4>App TV</h4>
                        <a className='btn' href='#'><Icon.GooglePlay/> Google Play Store</a>
                        <a className='btn' href='#'><Icon.Apple/> Apple Store</a>
                    </div>
                </div>
                <br/>
                <div className='container copyright'>
                    <p>@2022 Global LTV <span>All right reserved</span></p>
                </div>
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
       dispatch,
       ...bindActionCreators(dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
         ...state
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(Footer);
