import axios from "axios";
import store from "store";
import router from "router";
import { get, includes, isArray, join } from "@/utils/lodash"; 

let token = get(store, "getters.auth.token", null);

const http = axios.create({
  baseURL: __dirname + 'api',
  withCredentials: true,
  headers: {
    common: {
      "X-Requested-With": "XMLHttpRequest"
    },
    Authorization: token ? token : null
  }
});

// Add a request interceptor
http.interceptors.request.use(
  function(config) {
    let token = store.getters["auth/token"];

    if (token != null) {
      config.headers.Authorization = token;
    }

    return config;
  },
  function(err) {
    return Promise.reject(err);
  }
);

// Add a response interceptor
http.interceptors.response.use(
  function(response) {
    return response;
  },
  function(error) {
    let message = get(error.response.data, 'message');

    if(isArray(message)) {
        message = join(message, "<br />");
    }

    if (includes([401, 403], error.response.status)) {
      store.dispatch("auth/logout");
      router.push({ name: "login" });
    }

    return Promise.reject(error);
  }
);

export default http;
