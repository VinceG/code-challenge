import { isEmpty, get } from "@/utils/lodash";
import http from "@/services/http";
import cookie from "vue-cookie";

const state = {
    user: null,
    token: cookie.get("token")
};

// getters
const getters = {
    id: state => get(state.user, "id"),
    user: state => state.user,
    name: state => get(state.user, "name"),
    email: state => get(state.user, "email"),
    token: state => state.token,
    isLoggedIn: state => !isEmpty(state.user)
};

// actions
const actions = {
    auth({ commit, dispatch }, fields) {
        return new Promise((resolve, reject) => {
            http.post(`auth/login`, fields)
                .then(({ data }) => {
                    commit("USER_SET_TOKEN", data.data);
                    dispatch('me');
                    resolve(data);
                })
                .catch(({ response }) => reject(response.data));
        });
    },
    me({ commit }) {
        return new Promise((resolve, reject) => {
            http.get(`me`)
                .then(({ data }) => {
                    commit("USER_ME", data.data);
                    resolve(data.data);
                })
                .catch(({ response }) => {
                    reject(response);
                });
        });
    },
    logout({ commit }) {
        commit("USER_AUTH_CLEAR");
    }
};

// mutations
const mutations = {
    USER_SET_TOKEN(state, data) {
        state.token = data.token;

        cookie.set("token", state.token);
    },
    USER_ME(state, user) {
        state.user = user;
    },
    USER_AUTH_CLEAR(state) {
        state.token = null;
        state.user = null;

        cookie.delete("token");
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
