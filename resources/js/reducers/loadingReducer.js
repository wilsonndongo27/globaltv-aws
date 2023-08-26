import { IS_LOADING } from "./actions/types"

const initialState = {
    is_loading:false,
  }

const loadingReducer = (state = initialState, action) => {
    switch (action.type) {
      case IS_LOADING:
        return {
            is_loading: action.value
        }
      default:
        return state
    }
}

export default loadingReducer
