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
} from './types';
import { BaseUrl, dataAuth, headerAuth } from '../../api/config';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

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
        fetch(`${BaseUrl}/api/auth`, dataAuth)
        .then((res) => res.json())
        .then((resJson) => {
            if(resJson.access_token){
                store.dispatch({type:INFO_AUTH, value:resJson });
                const nextData = {
                    method: 'GET',
                    headers: {
                        'content-type': 'application/json',
                        'Authorization': `Bearer ${resJson.access_token}`,
                    }
                }
                if(data.key == 1){
                    fetch(`${BaseUrl}/api/news`, nextData)
                    .then((res) => res.json())
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:LIST_DATA_VIEW,
                            value:resJson.allnews
                        })
                    })
                    store.dispatch({type:LIST_PAGE_KEY, value:data.key});
                }

                if(data.key == 2){
                    fetch(`${BaseUrl}/api/interviews`, nextData)
                    .then((res) => res.json())
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:LIST_DATA_VIEW,
                            value:resJson.allinterviews
                        })
                        store.dispatch({type:LIST_PAGE_KEY, value:data.key});
                    })
                }
                
                if(data.key == 3){
                    fetch(`${BaseUrl}/api/replay`, nextData)
                    .then((res) => res.json())
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:LIST_DATA_VIEW,
                            value:resJson.allreplay
                        })
                        store.dispatch({type:LIST_PAGE_KEY, value:data.key});
                    })
                }

                if(data.key == 4){
                    fetch(`${BaseUrl}/api/replay-program/${data.item}`, nextData)
                    .then((res) => res.json())
                    .then((resJson) => {
                        store.dispatch({type:IS_LOADING, value:false});
                        store.dispatch({
                            type:LIST_DATA_VIEW,
                            value:resJson.replayprogramme
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

/**Actions pour Visualiser les details  */
export const detailViewAction = (data) =>
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

