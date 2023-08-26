import { INFO_AUTH } from "./actions/types"

const initialState = {
    infosUser:{},
  }

const authReducer = (state = initialState, action) => {
    switch (action.type) {
      case INFO_AUTH:
        return {
          ...state,
          infosUser: action.value
        }
      default:
        return state
    }
}

export default authReducer
