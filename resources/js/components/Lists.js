import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import ReactCountryFlag from "react-country-flag"
import ListItem from './ListItem';
import Flatlist from 'flatlist-react';
import LeftBarTopNews from './LeftBarTopNews';

class Lists extends Component {
    constructor(props){
        super(props);
        this.state = {
            visibleComment:false,
        }
    }

    _toggleCommentBlock = () => {
        this.setState({
            visibleComment:!this.state.visibleComment,
        });
    }

    _renderItem = (item) => {
        const {listkey} = this.props;
        return (
            <ListItem item={item} key={item.id} listkey={listkey} />
        )
    }

    render () {
        const {listdataview, listkey} = this.props;
        return (
            <div className='blocklist container'>
                <div className='row'>
                    {
                        listkey == 3 || listkey == 4 || listkey == 5 ?
                            <div className='col-lg-3 leftblock'>
                                <LeftBarTopNews/>
                            </div>
                        :
                            <div className='col-lg-3 leftblock'>
                                <div className='paysblock'>
                                    <h4 className='titlefilterlist'>Pays</h4>
                                    <div className='card checkboxpays'>
                                        <div className='itempays'>
                                            <input type='checkbox' className='col-lg-3' />
                                            <p className='col-lg-7'>Cameroun</p>
                                            <ReactCountryFlag countryCode='CM' svg className='col-lg-3' />
                                        </div>
                                        <div className='itempays'>
                                            <input type='checkbox' className='col-lg-3' />
                                            <p className='col-lg-7'>France</p>
                                            <ReactCountryFlag countryCode='FR' svg className='col-lg-3' />
                                        </div>
                                        <div className='itempays'>
                                            <input type='checkbox' className='col-lg-3' />
                                            <p className='col-lg-7'>Algérie</p>
                                            <ReactCountryFlag countryCode='AG' svg className='col-lg-3' />
                                        </div>
                                    </div>
                                </div>
                                <div className='themeblock'>
                                    <h4 className='titlefilterlist'>Thèmes</h4>
                                    <div className='card checkboxtheme'>
                                        <div className='itemtheme'>
                                            <input type='checkbox' className='col-lg-3' />
                                            <p className='col-lg-6'>Technologie</p>
                                        </div>
                                        <div className='itemtheme'>
                                            <input type='checkbox' className='col-lg-3' />
                                            <p className='col-lg-6'>Sport</p>
                                        </div>
                                        <div className='itemtheme'>
                                            <input type='checkbox' className='col-lg-3' />
                                            <p className='col-lg-6'>Culture</p>
                                        </div>
                                        <div className='itemtheme'>
                                            <input type='checkbox' className='col-lg-3' />
                                            <p className='col-lg-6'>Tourisme</p>
                                        </div>
                                        <div className='itemtheme'>
                                            <input type='checkbox' className='col-lg-3' />
                                            <p className='col-lg-6'>Personne</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    }
                    <div className='col-lg-9'>
                        {
                            listkey == 1 ?
                                <h4 className='titlelist'>Actualités</h4>
                            :
                            listkey == 2 ?
                                <h4 className='titlelist'>Interviews</h4>
                            :
                            listkey == 3 ?
                                <h4 className='titlelist'>Replays</h4>
                            :
                            listkey == 4 ?
                                <h4 className='titlelist'>Replays Programme</h4>
                            :
                            listkey == 5 ?
                                <h4 className='titlelist'>Podcasts</h4>
                            :null
                        }
                        <div className='itemlistblock row'>
                            <Flatlist
                                list={listdataview}
                                renderItem={this._renderItem}
                            />
                        </div>
                    </div>
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
        listdataview:state.dataManager.list_view,
        listpagekey:state.navigation.listpagekey,
   }
 }

export default connect(mapStateToProps, mapDispatchToProps, null)(Lists);
