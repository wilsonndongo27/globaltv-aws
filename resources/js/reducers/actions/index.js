import { store } from '../store';
import { NAVIGATE_DETAIL, 
    NAVIGATE_LIST, 
    NAVIGATE_LIVE,
    IS_LOADING,
    INFO_AUTH,
    HOME_DATA,
    LIST_DATA_VIEW,
    DETAIL_VIEW,
    LIST_PAGE_KEY,
    DETAIL_PAGE_KEY,
    FLASH_INFO,
    LIVE_PLAYING
} from './types';
import { BaseUrl, dataAuth, headerAuth } from '../../api/config';
import axios from 'axios';

/**Manage Navigation */
export const DetailSwicht = (data) => {
    store.dispatch({type:NAVIGATE_DETAIL, value:data});
}
export const ListSwicht = (data) => {
    store.dispatch({ type : NAVIGATE_LIST, value:data });
}
export const LiveSwicht = (data) => {
    store.dispatch({ type : NAVIGATE_LIVE, value:data });
}
export const LivePlayingSwicht = (data) => {
    store.dispatch({ type : LIVE_PLAYING, value:data });
}

/**Actions de la data page d'accueil */
export const homeActionData = () =>
{
    try {
        store.dispatch({type:IS_LOADING, value:true});
        axios.post(`${BaseUrl}api/auth`, dataAuth)
        .then((resJson) => {
            if(resJson.data.access_token){
                store.dispatch({type:INFO_AUTH, value:resJson });
                const nextData = {
                    headers: {
                        'Authorization': 'Bearer ' + resJson.data.access_token,
                        'content-type': 'multipart/form-data' 
                    }
                }
                axios.get(`${BaseUrl}api/home`, nextData)
                .then((resJson) => {
                    store.dispatch({type:IS_LOADING, value:false});
                    var flash_info = [];
                    resJson.data.allnews.map((item) => {
                        flash_info.push(item.title);
                    })
                    store.dispatch({
                        type:FLASH_INFO,
                        value:flash_info
                    })
                    store.dispatch({
                        type:HOME_DATA,
                        value:resJson.data
                    })
                })
            }
        })
        
    } catch (err) {
        store.dispatch({type:IS_LOADING, value:true});
        console.log('une erreur est survenue', err)
    }
}

/**Actions pour Visualiser les listes  */
export const listViewAction = (data) =>
{
    try {
        store.dispatch({type:IS_LOADING, value:true});
        axios.post(`${BaseUrl}api/auth`, dataAuth)
        .then((resJson) => {
            if(resJson.data.access_token){
                store.dispatch({type:INFO_AUTH, value:resJson });
                const nextData = {
                    headers: {
                        'Authorization': 'Bearer ' + resJson.data.access_token,
                        'content-type': 'multipart/form-data' 
                    }
                }
                if(data.key == 1){
                    axios.get(`${BaseUrl}api/news`, nextData)
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:LIST_DATA_VIEW,
                            value:resJson.data.allnews
                        })
                    })
                    store.dispatch({type:LIST_PAGE_KEY, value:data.key});
                }

                if(data.key == 2){
                    axios.get(`${BaseUrl}api/interview`, nextData)
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:LIST_DATA_VIEW,
                            value:resJson.data.allinterview
                        })
                        store.dispatch({type:LIST_PAGE_KEY, value:data.key});
                    })
                }
                
                if(data.key == 3){
                    axios.get(`${BaseUrl}api/replay`, nextData)
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:LIST_DATA_VIEW,
                            value:resJson.data.allreplay
                        })
                        store.dispatch({type:LIST_PAGE_KEY, value:data.key});
                    })
                }

                if(data.key == 4){
                    axios.get(`${BaseUrl}api/replay-program/${data.item}`, nextData)
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:LIST_DATA_VIEW,
                            value:resJson.data.replayprogramme
                        })
                        store.dispatch({type:LIST_PAGE_KEY, value:data.key});
                    })
                }

                if(data.key == 5){
                    axios.get(`${BaseUrl}api/podcast`, nextData)
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:LIST_DATA_VIEW,
                            value:resJson.data.allpodcast
                        })
                        store.dispatch({type:LIST_PAGE_KEY, value:data.key});
                    })
                }

                if(data.key == 6){
                    axios.get(`${BaseUrl}api/program`, nextData)
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:LIST_DATA_VIEW,
                            value:resJson.data.allprogram
                        })
                        store.dispatch({type:LIST_PAGE_KEY, value:data.key});
                    })
                }
               
            }
        })
        
    } catch (err) {
        store.dispatch({type:IS_LOADING, value:true});
        console.log('une erreur est survenue', err)
    }
}

/**Actions pour Visualiser les details à l'accueil */
export const detailHomeViewAction = (data) =>
{
    try {
        store.dispatch({type:IS_LOADING, value:true});
        if(data.key == 1){
            store.dispatch({type:IS_LOADING, value:false});
            store.dispatch({
                type:DETAIL_VIEW,
                value:data.item
            })
            store.dispatch({type:DETAIL_PAGE_KEY, value:data.key});    
            //navigate('/#detailblock');
        }
        if(data.key == 2){
            store.dispatch({type:IS_LOADING, value:false});
            store.dispatch({
                type:DETAIL_VIEW,
                value:data.item
            })
            store.dispatch({type:DETAIL_PAGE_KEY, value:data.key});
        }

        if(data.key == 4){
            store.dispatch({type:IS_LOADING, value:false});
            store.dispatch({
                type:DETAIL_VIEW,
                value:data.item
            })
            store.dispatch({type:DETAIL_PAGE_KEY, value:data.key});
        }
        
    } catch (err) {
        store.dispatch({type:IS_LOADING, value:true});
        console.log('une erreur est survenue', err)
    }
}

/**Actions pour Visualiser les details dans les listes  */
export const detailViewAction = (data) =>
{
    try {
        store.dispatch({type:IS_LOADING, value:true});
        axios.post(`${BaseUrl}api/auth`, dataAuth)
        .then((resJson) => {
            if(resJson.data.access_token){
                store.dispatch({type:INFO_AUTH, value:resJson });
                const nextData = {
                    headers: {
                        'Authorization': 'Bearer ' + resJson.data.access_token,
                        'content-type': 'multipart/form-data' 
                    }
                }
                if(data.key == 1){
                    axios.get(`${BaseUrl}api/one-news/${data.id}`, nextData)
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:DETAIL_VIEW,
                            value:resJson.data.news_info
                        })
                    })
                    store.dispatch({type:DETAIL_PAGE_KEY, value:data.key});
                }

                if(data.key == 2){
                    axios.get(`${BaseUrl}api/one-interview/${data.id}`, nextData)
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:DETAIL_VIEW,
                            value:resJson.data.interview_info
                        })
                    })
                    store.dispatch({type:DETAIL_PAGE_KEY, value:data.key});
                }

                if(data.key == 3){
                    axios.get(`${BaseUrl}api/one-replay/${data.id}`, nextData)
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:DETAIL_VIEW,
                            value:resJson.data.replay_info
                        })
                    })
                    store.dispatch({type:DETAIL_PAGE_KEY, value:data.key});
                }

                if(data.key == 6){
                    axios.get(`${BaseUrl}api/one-program/${data.id}`, nextData)
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:DETAIL_VIEW,
                            value:resJson.data.program_info
                        })
                        store.dispatch({type:LIST_PAGE_KEY, value:data.key});
                    })
                }
               
            }
        })
        
    } catch (err) {
        store.dispatch({type:IS_LOADING, value:true});
        console.log('une erreur est survenue', err)
    }
}

