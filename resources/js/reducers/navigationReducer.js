import { NAVIGATE_DETAIL, NAVIGATE_LIST, NAVIGATE_LIVE, DETAIL_PAGE_KEY, LIST_PAGE_KEY } from "./actions/types"

const initialState = {
    visibleDetail:false,
    visibleList:false,
    visibleLive:false,
    listpagekey:'',
    detailpagekey:'',

  }

const navigationReducer = (state = initialState, action) => {
    switch (action.type) {
      case NAVIGATE_DETAIL:
        return {
          ...state,
          visibleDetail: action.value
        }
      case NAVIGATE_LIST:
        return {
          ...state,
          visibleList: action.value
        }
      case NAVIGATE_LIVE:
        return {
          ...state,
          visibleLive: action.value
        }
      case DETAIL_PAGE_KEY:
        return {
          ...state,
          detailpagekey: action.value
        }
      case LIST_PAGE_KEY:
        return {
          ...state,
          listpagekey: action.value
        }
  

      default:
        return state
    }
}

export default navigationReducer
