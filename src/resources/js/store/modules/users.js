import http from "@/services/http";

const state = {
    users: []
};

// getters
const getters = {
    users: state => state.users
};

// actions
const actions = {
    async all({ commit }) {
        let { data } = await http.get('users');
        commit('USERS_SET', data.data);
        return data;
    },
    async submit({ commit }, fields) {
        let { data } = await http.post(`users/save`, fields);

        commit('USERS_PUSH', data.data)

        return data;
    },
    async clear({ commit }) {
        commit("USERS_CLEAR");
    }
};

// mutations
const mutations = {
    USERS_SET(state, users) {
        state.users = users;
    },
    USERS_PUSH(state, user) {
        state.users.push(user);
    },
    USERS_CLEAR(state) {
        state.users = [];
    }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
