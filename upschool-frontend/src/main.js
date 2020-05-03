import Vue from "vue";
import App from "./App.vue";
import vuetify from "./plugins/vuetify";
import axios from "axios";
import store from "./store/store";
// import TrixEditor from "@dymantic/vue-trix-editor";
import router from "./routes/router";
import lineClamp from "vue-line-clamp";
import moment from "moment";
import Echo from "laravel-echo";
import VueTour from "vue-tour";
// import Pusher from "pusher-js";
import "./includes";

require("vue-tour/dist/vue-tour.css");

Vue.use(VueTour);

Vue.use(lineClamp, {
	// plugin options
});

const pusher = require("pusher-js");

const echo = new Echo({
	broadcaster: "pusher",
	key: "anyKey",
	wsHost: "127.0.0.1",
	wsPort: 6001,
	// wssPort: 6001,
	disableStats: true,
});

axios.defaults.baseURL = "http://127.0.0.1:8000/api/";

const token = store.state.token;

if (token) {
	axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
	// store.dispatch("getUser");
}

import "@mdi/font/css/materialdesignicons.css";

import "./assets/styles/main.scss";
// import { createProvider } from './vue-apollo'

Vue.prototype.moment = moment;
Vue.prototype.echo = echo;
Vue.prototype.pusher = pusher;

Vue.config.productionTip = false;

new Vue({
	store,
	router,
	lineClamp,
	vuetify,
	// apolloProvider: createProvider(),
	render: (h) => h(App),
}).$mount("#app");
