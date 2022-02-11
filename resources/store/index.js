import Vue from 'vue';
import Vuex from 'vuex';
import router from '../router';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    selectedRow: {},
    properties: [],
    currentPath: '',
    isShowingOptions: false,
  },
  mutations: {
    setSelectedRow(state, payload) {
      state.selectedRow = payload;
    },
    setProperties(state, payload) {
      state.properties = payload;
    },
    setCurrentPath(state, payload) {
      state.currentPath = payload;
    },
    setIsShowingOptions(state) {
      state.isShowingOptions = !state.isShowingOptions;
    },
  },
  actions: {
    goTo({ commit }, path) {
      commit('setCurrentPath', path);
      router.push({ path });
    },
    // eslint-disable-next-line no-unused-vars
    objValuesToString({ commit }, obj) {
      const keys = Object.keys(obj);
      const auxObj = {};
      keys.forEach((key) => {
        if (obj[key]) {
          auxObj[key] = obj[key].toString();
        } else {
          auxObj[key] = '';
        }
      });
      return auxObj;
    },

  },
  modules: {
  },
});
