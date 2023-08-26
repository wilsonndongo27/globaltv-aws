import { combineReducers } from "redux";
import navigationReducer from "./navigationReducer";
import loadingReducer from "./loadingReducer";
import globalReducer from "./globalReducer"
import authReducer from "./authReducer";

export const rootReducer = combineReducers(
  {
    navigation : navigationReducer,
    loading : loadingReducer,
    dataManager : globalReducer,
    authApi : authReducer
  }
)
