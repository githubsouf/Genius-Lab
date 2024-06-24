import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
  state: {
    isAuthenticated: false,
    user: null,
    token: null,
    parentId: null,
    children: [],
    animateurs: [], // Add animateurs state
    userType: null // Add userType state
  },
  mutations: {
    setToken(state, token) {
      state.token = token;
      localStorage.setItem('token', token);
    },
    setUser(state, userData) {
      state.isAuthenticated = true;
      state.user = userData;
    },
    setParentId(state, parentId) {
      state.parentId = parentId;
    },
    setChildren(state, children) {
      state.children = children;
    },
    setAnimateurs(state, animateurs) {
      state.animateurs = animateurs;
    },
    setUserType(state, userType) {
      state.userType = userType;
    },
    logout(state) {
      state.isAuthenticated = false;
      state.user = null;
      state.token = null;
      state.parentId = null;
      state.children = [];
      state.animateurs = [];
      state.userType = null;
      localStorage.removeItem('token');
    }
  },
  actions: {
    async loginUser({ commit, dispatch }, credentials) {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', credentials);
        const token = response.data.token;
        commit('setToken', token);
        await dispatch('fetchUserDetails', token);
      } catch (error) {
        console.error('Login failed:', error);
        throw new Error('Login failed');
      }
    },
    async fetchUserDetails({ commit, dispatch, state }) {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/user', {
          headers: {
            Authorization: `Bearer ${state.token}`
          }
        });
        const userData = response.data;
        commit('setUser', userData);

        // Check if user is a parent
        const parentResponse = await axios.get(`http://127.0.0.1:8000/api/parental`, {
          headers: {
            Authorization: `Bearer ${state.token}`
          },
          params: {
            user_id: userData.id
          },
        });
        const parent = parentResponse.data.find(parent => parent.user_id === userData.id);
        if (parent) {
          commit('setParentId', parent.id);
          commit('setUserType', 'parent');
          await dispatch('fetchChildren', parent.id);
        } else {
          // Check if user is an animateur
          const animateurResponse = await axios.get(`http://127.0.0.1:8000/api/animateurs`, {
            headers: {
              Authorization: `Bearer ${state.token}`
            },
            params: {
              user_id: userData.id
            }
          });
          const animateur = animateurResponse.data.find(animateur => animateur.user_id === userData.id);
          if (animateur) {
            commit('setUserType', 'animateur');
          } else {
            commit('setUserType', 'other');
          }
        }
      } catch (error) {
        console.error('Failed to fetch user details:', error);
        throw new Error('Failed to fetch user details');
      }
    },
    async fetchChildren({ commit, state }, parentId) {
      try {
        const response = await axios.get(`http://127.0.0.1:8000/api/parentals/${parentId}/enfants`, {
          headers: {
            Authorization: `Bearer ${state.token}`
          }
        });
        commit('setChildren', response.data);
      } catch (error) {
        console.error('Failed to fetch children data:', error);
        throw new Error('Failed to fetch children data');
      }
    },
    async fetchAnimateurs({ commit, state }) {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/animateurs', {
          headers: {
            Authorization: `Bearer ${state.token}`
          }
        });
        commit('setAnimateurs', response.data);
      } catch (error) {
        console.error('Failed to fetch animateurs data:', error);
        throw new Error('Failed to fetch animateurs data');
      }
    },
    logoutUser({ commit }) {
      commit('logout');
    }
  },
  getters: {
    isAuthenticated: state => state.isAuthenticated,
    currentUser: state => state.user,
    parentId: state => state.parentId,
    children: state => state.children,
    animateurs: state => state.animateurs,
    userType: state => state.userType,
    token: state => state.token,
  }
});

export default store;
