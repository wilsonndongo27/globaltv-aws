import React, { Component } from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import  '../assets/css/style.css';
import  '../assets/css/responsive.css';
import ReactCountryFlag from "react-country-flag"
import * as Icon from 'react-bootstrap-icons';
import {BaseUrl} from '../api/config';
import {detailViewAction, DetailSwicht, ListSwicht} from '../reducers/actions'
import Moment from 'moment';
import 'moment/locale/fr';
import Carousel from 'react-multi-carousel';
import "react-multi-carousel/lib/styles.css";

class ProgramItem extends Component {
    constructor(props){
        super(props);
        this.state = {
        }
    }

    _toggleDetail = (item, key) => {
        const {visibleDetail, visibleList} = this.props;
        if(visibleList == true){
            ListSwicht(false);
        }
        if(!visibleDetail == true){
            DetailSwicht(!visibleDetail);
        }
        const data = {
            'item':item,
            'key':key
        };
        detailViewAction(data);
    }

    _padTo2Digits = (num) => {
        return num.toString().padStart(2, '0');
    }

    _redirectProgram = () => {

    }

    render() {
        const {item, key, listpagekey, allprogram} = this.props;
        return (
            <div className='tvprogramblock container'>
                <div className='hearderblockprogramtv'> 
                    <h4>Programme TV</h4>
                    <a href='#' className='linkallprogram'>
                        Voir Tous <span><Icon.ArrowRightCircle className='iconviewallprogram'/></span>
                    </a>
                </div>
                <div className='blockitemprogrammetv'>
                    {
                        allprogram ?
                            <Carousel
                                slidesToSlide={3}
                                swipeable={true}
                                draggable={true}
                                showDots={true}
                                minimumTouchDrag={3}
                                responsive={responsive}
                                infinite={true}
                                autoPlay={true}
                                autoPlaySpeed={5000}
                                keyBoardControl={true}
                                customTransition="all .5"
                                transitionDuration={1000}
                                containerClass="carousel-container"
                                removeArrowOnDeviceType={["tablet", "mobile"]}
                                deviceType={this.props.deviceType}
                                dotListClass="custom-dot-list-style"
                                itemClass="carousel-item-padding-40-px itemcsscaroussel"
                            >
                                {
                                    allprogram.map((item, i) => 
                                        <div className='' key={i}>
                                            <img src={ BaseUrl + 'storage/' + item.cover } className='imageprogrammetv' />
                                            <div className='timeblockprogram'>
                                                <p>
                                                <span className='style'>{item.day} à {Moment(item.date+'T'+item.time_start).format('HH:mm')}</span> 
                                                <span><Icon.Dot/> {Moment(item.date+'T'+item.time_start).fromNow()}</span> 
                                                </p>
                                            </div>
                                            <div className='titlebanner'>
                                                <p onClick={this._redirectProgram(this, item)}>{item.title}</p>
                                            </div>
                                        </div>
                                    )
                                }
                            </Carousel>
                        :null
                    }
                 
                </div>
            </div>
        );
    }
}

const responsive = {
    desktop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 3 // optional, default to 1.
    },
    tablet: {
      breakpoint: { max: 1024, min: 464 },
      items: 2 // optional, default to 1.
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 1 // optional, default to 1.
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
       ...bindActionCreators({detailViewAction, DetailSwicht, ListSwicht}, dispatch),
     }
 };

 const mapStateToProps = (state) => {
    return {
        visibleList:state.navigation.visibleList,
        visibleDetail:state.navigation.visibleDetail,
        allprogram: state.dataManager.homedata.allprogram,
    }
  }

 export default connect(mapStateToProps, mapDispatchToProps, null)(ProgramItem);
