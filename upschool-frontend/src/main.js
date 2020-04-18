import Vue from "vue";
import App from "./App.vue";
import vuetify from "./plugins/vuetify";
import axios from "axios";
import store from "./store/store";
// import TrixEditor from "@dymantic/vue-trix-editor";
import router from "./routes/router";
import lineClamp from "vue-line-clamp";
import "./includes";

Vue.use(lineClamp, {
	// plugin options
});

axios.defaults.baseURL = "http://127.0.0.1:8000/api/";

// const token = localStorage.getItem("user-token");
const token = store.state.token;

if (token) {
	axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}

import "@mdi/font/css/materialdesignicons.css";

import "./assets/styles/main.scss";
// import { createProvider } from './vue-apollo'

Vue.config.productionTip = false;
// Vue.config.ignoredElements = ["trix-vue"];

new Vue({
	store,
	router,
	lineClamp,
	vuetify,
	// apolloProvider: createProvider(),
	render: h => h(App)
}).$mount("#app");
