import { HOME_DATA, LIST_DATA_VIEW, DETAIL_VIEW } from "./actions/types"

const initialState = {
    homedata:{},
    list_view:{},
    detail_view:{},
  }

const globalReducer = (state = initialState, action) => {
    switch (action.type) {
      case HOME_DATA:
        return {
          ...state,
          homedata: action.value
        }
      case LIST_DATA_VIEW:
        return {
          ...state,
          list_view: action.value
        }
      case DETAIL_VIEW:
        return {
          ...state,
          detail_view: action.value
        }
      default:
        return state
    }
}

export default globalReducer
