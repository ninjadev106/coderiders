import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        auth: {
            token: "",
            user: {}
        },
        orderNumber: 342534636,
        activePlanId: "",
        usersCount: 245,
        plansData: []
    },
    getters: {
        currentPlan(state) {
          return state.plansData.find(item => state.activePlanId === item.id)
      }
    },
    mutations: {
        setBoxes(state, data) {
            state.plansData = data;
        },
        addBox(state, data) {
            state.plansData.push(data);
        },
        setToken(state, token) {
            state.auth.token = token;
        },
        setUser(state, user) {
            state.auth.user = user;
        },
        removeAuth(state) {
            axios
                .post("http://127.0.0.1:8000/api/logout", {}, {
                    headers: {
                        "Authorization": `Bearer ${localStorage.getItem("token")}`
                    }
                })
                .then(() => {
                    localStorage.removeItem("token");
                    state.auth = {
                        token: "",
                        user: {}
                    };
                })
                .catch(err => console.error(err.response.data));


        },
        checkout(state, plan) {
            let index = state.plansData.findIndex(item => item.id === plan.id);
            state.activePlanId = plan.id;
            state.plansData[index] = plan;
        },
        updateCard(state, payload) {
            let index = state.plansData.findIndex(item => item.id === payload.id)
            state.plansData[index] = {
                updated: true,
                ...payload
            }
        }
    }
});
