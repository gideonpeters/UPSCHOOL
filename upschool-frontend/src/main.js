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
const token = `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4NTc5NDkxNSwiZXhwIjoxNTg2Mzk5NzE2LCJuYmYiOjE1ODU3OTQ5MTYsImp0aSI6InU1M2dMWU9OSXRPdlhScHgiLCJzdWIiOjMsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.DahXrrizT0L-Np136mnSZJD7K6vI6dWjLqutdE8RePg`;

if (token) {
	axios.defaults.headers.common["Authorization"] = token;
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
