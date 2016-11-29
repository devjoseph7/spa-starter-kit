import axios from 'axios'
import { isArray } from 'lodash'
import store from '../store'
import router from '../router'
import { apiUrl } from '../config'

const http = axios.create({
  baseURL: apiUrl,
})

/**
* Helper method to set the header with the token
*/
export function setToken(token) {
  http.defaults.headers.common.Authorization = `Bearer: ${token}`
}

http.interceptors.response.use(
  response => response,
  /**
  * This is a central point to handle all
  * error messages generated by HTTP
  * requests
  */
  (error) => {
    /**
    * If token is either expired, not provided or invalid
    * then redirect to login. On server side the error
    * messages can be changed on app/Providers/EventServiceProvider.php
    */
    if (error.response.data.reason === 'token') {
      router.push({ name: 'login.index' })
    }
    /**
    * Error messages are sent in arrays
    */
    if (isArray(error.response.data)) {
      store.dispatch('setMessage', { type: 'error', message: error.response.data.messages })
    /**
    * Laravel generated validation errors are
    * sent in an object
    */
    } else {
      store.dispatch('setMessage', { type: 'validation', message: error.response.data })
    }
    store.dispatch('setFetching', { fetching: false })
    return Promise.reject(error)
  }
)

export default function install(Vue) {
  Object.defineProperties(Vue.prototype, {
    $http: {
      get() {
        return http
      },
    },
  })
}
