import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';
import {Button, Container, Form, Nav, Navbar, NavDropdown} from 'react-bootstrap';
import logo from '../assets/img/logo.png';
import * as Icon from 'react-bootstrap-icons';
import FadeIn from 'react-fade-in';
import {LiveSwicht, ListSwicht, listViewAction, DetailSwicht, LivePlayingSwicht} from '../reducers/actions'
import  secureLocalStorage  from  "react-secure-storage";
import {BaseUrl} from '../api/config';
import Textra from 'react-textra'
import Parser from 'html-react-parser';

class NavBarBlock extends Component {
    constructor(props){
        super(props);
        this.state = {
            searchVisible:false,
            programmeVisible:false,
            languevisible:false
        }
    }

    _toggleSearch = () => {
        this.setState({searchVisible:!this.state.searchVisible});
    }

    _toggleProgramme = () => {
        this.setState({programmeVisible:!this.state.programmeVisible});
    }
    _toggleLangue = () => {
        this.setState({languevisible:!this.state.languevisible});
    }

    _redirectList = async (key) => {
        const {listpagekey} = this.props;
        if(!listpagekey == 3 || !listpagekey == 4){
            this._toggleProgramme();
        }   
        
        const data = {
            'key':key
        };
        await secureLocalStorage.setItem('listkey', JSON.stringify(data));
        window.location.replace(BaseUrl + 'list/');
    }

    _redirectDetail = async (id, key) => {
        const {listpagekey} = this.props;
        if(!listpagekey == 3 || !listpagekey == 4){
            this._toggleProgramme();
        }   
        
        const data = {
            'id':id,
            'key':key
        };
        await secureLocalStorage.setItem('detailkey', JSON.stringify(data));
        window.location.replace(BaseUrl + 'detail/'+id+'/');
    }

    _toggleLive = async () => {
        const {visibleLive,livePlaying} =this.props;
        await LivePlayingSwicht(!livePlaying);
        await LiveSwicht(!visibleLive);
    }

    render() {
        const {allprogram, flash_info} = this.props;
        return (
            <div>
                <div className='card infoflash'>
                    <div className='container blockmonaislive'>
                        <span className='monnaistitle'>Monnais :</span>
                        <div className='defiler'>
                            <marquee className='col-lg-6'>
                                <span>0,09320,0006 RUB/INR <Icon.ArrowDownCircle className='iconcurrency icondown' /></span>
                                <span>1,40920,01 RUB/CNY <Icon.ArrowUpCircle className='iconcurrency iconup' /></span>
                                <span>0,12090,0009 RUB/ZAR <Icon.ArrowDownCircle className='iconcurrency icondown' /></span>
                                <span>0,28930,0024 BRL/RUB <Icon.ArrowDownCircle className='iconcurrency icondown' /></span>
                                <span>10,75030,0157 BRL/INR <Icon.ArrowUpCircle className='iconcurrency iconup' /></span>
                                <span>15,14890,0221 BRL/CNY <Icon.ArrowUpCircle className='iconcurrency iconup' /></span>
                                <span>1,29970,0017 BRL/ZAR <Icon.ArrowUpCircle className='iconcurrency iconup' /></span>
                            </marquee>

                            {/* Block News */}
                            <div className='col-lg-6 blocktopnews'> 
                                <span className='topinfotitle'>Top Infos : </span>
                                <div className='topnewscontent'>
                                    <Textra 
                                        effect='flash' 
                                        stopDuartion={4000} 
                                        data={flash_info} 
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className='blocklangue'> 
                        <span className='languagetitle' onClick={this._toggleLangue}>Langue : <span>FR</span> <Icon.ArrowDownCircleFill /></span>
                        {
                            this.state.languevisible ?
                                <div className='menulangue'>
                                    <ul>
                                        <li><a href='#'>EN</a></li>
                                        <li><a href='#'>RU</a></li>
                                        <li><a href='#'>CH</a></li>
                                    </ul>
                                </div>
                            :null
                        }
                    
                    </div>
                </div>
                <Navbar expand="lg" className='header container'>
                    <Container fluid>
                        <Navbar.Brand href="/" className='logoblock'>
                            <img src={logo} className='logo'/>
                        </Navbar.Brand>
                        <Navbar.Toggle aria-controls="navbarScroll" />
                        <Navbar.Collapse id="navbarScroll">
                            <Nav className="me-auto my-2 my-lg-0 navitemblock" navbarScroll>
                                <Nav.Link href="/" active className='itemheader'>Accueil</Nav.Link>
                                <Nav.Link href="#" className='itemheader' onClick={this._redirectList.bind(this, 3)}>Replay</Nav.Link>
                                <Nav.Link href="#" className='itemheader' onClick={this._toggleLive}>Direct</Nav.Link>
                                <Nav.Link href="#" className='itemheader' onClick={this._toggleProgramme}>Programme TV</Nav.Link>
                            </Nav>
                            <Form className="d-flex">
                                {
                                    this.state.searchVisible ?
                                        <div>
                                            <Form.Control
                                                type="search"
                                                placeholder="Recherche..."
                                                className="me-2 searchinput"
                                                aria-label="Search"
                                            />
                                            <Icon.X className='logosearch2' onClick={this._toggleSearch} />
                                        </div>
                                    :
                                        <Icon.Search className='logosearch1' onClick={this._toggleSearch} />
                                }
                            </Form>
                        </Navbar.Collapse>
                    </Container>
                </Navbar>
                {
                    this.state.programmeVisible ?
                        <FadeIn delay='100' transitionDuration='1000' >
                            <div className='submenusblock'>
                                {
                                    allprogram ?
                                        allprogram.map((item, i) => 
                                            <div className='itemsubmenu col-lg-3' key={i}>
                                                <div className='itemcover'>
                                                    <img src={ BaseUrl + 'storage/' + item.cover} className='imagesubmenu' />
                                                    <div className='blocsubmenu'>
                                                        <a href='#' onClick={this._redirectDetail.bind(this, item.id, 6)}>{item.title}</a>
                                                        <p>{Parser(item.description.substring(0, 100))}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        )
                                    :null
                                }
                            </div>
                        </FadeIn>
                    :null
                }
            </div>
        );
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
       ...bindActionCreators({listViewAction, LiveSwicht, ListSwicht, DetailSwicht, LivePlayingSwicht}, dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
        listpagekey: state.navigation.listpagekey,
        visibleLive:state.navigation.visibleLive,
        livePlaying:state.navigation.livePlaying,
        visibleList:state.navigation.visibleList,
        allprogram:state.dataManager.homedata.allprogram,
        flash_info:state.dataManager.flash_info,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(NavBarBlock);
