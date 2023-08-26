import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';
import {Button, Container, Form, Nav, Navbar, NavDropdown} from 'react-bootstrap';
import logo from '../assets/img/logo.png';
import * as Icon from 'react-bootstrap-icons';
import FadeIn from 'react-fade-in';
import {LiveSwicht, ListSwicht, listViewAction, DetailSwicht} from '../reducers/actions'
import {BaseUrl} from '../api/config';

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

    _ListViewDataNav = (item, key) => {
        const {visibleList, listpagekey} = this.props;
        if(visibleList == false){
            ListSwicht(!visibleList);
        }
        const data = {
            'item':item,
            'key':key
        };
        listViewAction(data);
        if(!listpagekey == 3 || !listpagekey == 4){
            this._toggleProgramme();
        }
    }

    _toggleLive = () => {
        const {visibleLive} = this.props;
        LiveSwicht(!visibleLive);
    }

    render() {
        const {allprogrammes} = this.props;
        return (
            <div>
                <div className='card infoflash'>
                    <div className='container blockmonaislive'>
                        <span className='monnaistitle'>Monnais :</span>
                        <div className='defiler'>
                            <marquee className='col-lg-6'>
                                <span>0,09320,0006RUB/INR</span>
                                <span>1,40920,01RUB/CNY</span>
                                <span>0,12090,0009RUB/ZAR</span>
                                <span>0,28930,0024BRL/RUB</span>
                                <span>10,75030,0157BRL/INR</span>
                                <span>15,14890,0221BRL/CNY</span>
                                <span>1,29970,0017BRL/ZAR</span>
                            </marquee>
                            <div className='col-lg-6 blocktemperature'> 
                                <span className='monnaistitle'>Météo : </span>
                                <marquee>
                                    <span>Douala 8 °C</span>
                                    <span>Yaoundé 31 °C</span>
                                    <span>Bafoussam 28 °C</span>
                                    <span>Bamenda 36 °C</span>
                                </marquee>
                            </div>
                        </div>
                    </div>
                    <div className='blocklangue'> 
                        <span className='monnaistitle' onClick={this._toggleLangue}>Langue : <span>FR</span> <Icon.ArrowDownCircleFill /></span>
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
                                <Nav.Link href="#" className='itemheader' onClick={this._ListViewDataNav.bind(this, null, 3)}>Replay</Nav.Link>
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
                                    allprogrammes ?
                                        allprogrammes.map((programme, i) => 
                                            <div className='itemsubmenu col-lg-3' key={i}>
                                                <div className='itemcover'>
                                                    <img src={ BaseUrl + '/storage/' + programme.image} className='imagesubmenu' />
                                                    <div className='blocsubmenu'>
                                                        <a href='#' onClick={this._ListViewDataNav.bind(this, programme.id, 4)}>{programme.title}</a>
                                                        <p>{programme.description}</p>
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
       ...bindActionCreators({listViewAction, LiveSwicht, ListSwicht, DetailSwicht}, dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
        listpagekey: state.navigation.listpagekey,
        visibleLive:state.navigation.visibleLive,
        visibleList:state.navigation.visibleList,
        allprogrammes:state.dataManager.homedata.allprogrammes,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(NavBarBlock);
