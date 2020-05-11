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
import VueChatScroll from "vue-chat-scroll";
// import Pusher from "pusher-js";
import "./includes";

import "@mdi/font/css/materialdesignicons.css";

import "./assets/styles/main.scss";

// import { createProvider } from './vue-apollo'
require("vue-tour/dist/vue-tour.css");

Vue.use(VueTour);
Vue.use(VueChatScroll);

Vue.use(lineClamp, {
	// plugin options
});

axios.defaults.baseURL = "http://127.0.0.1:8000/api/";

let token = localStorage.getItem(`upschool-token`);

if (token) {
	axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
	store.dispatch("getUser");
}
window.io = require("socket.io-client");

window.Echo = new Echo({
	broadcaster: "socket.io",
	host: "http://localhost:6001",
	auth: {
		headers: {
			Authorization: "Bearer " + token,
		},
	},
});

Vue.prototype.moment = moment;
// Vue.prototype.echo = echo;

Vue.config.productionTip = false;

new Vue({
	store,
	router,
	lineClamp,
	vuetify,
	// apolloProvider: createProvider(),
	render: (h) => h(App),
}).$mount("#app");
