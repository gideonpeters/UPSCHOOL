<template>
	<v-app>
		<div>
			<v-btn @click="doThis" color="success" tile>LET'S GET IT LIKE</v-btn>
		</div>
	</v-app>
</template>

<script>
import Axios from "axios";
import Echo from "laravel-echo";
export default {
	methods: {
		async doThis() {
			try {
				let res = await Axios.post("message");
				console.log(res.data);
			} catch (error) {
				console.log(error);
			}
		}
	},
	async mounted() {
		window.io = require("socket.io-client");
		let token = `Bearer ${localStorage.getItem("upschool-token")}`;
		window.Echo = new Echo({
			broadcaster: "socket.io",
			host: "http://localhost:6001",
			auth: {
				headers: {
					Authorization: token
				}
			}
		});
		let res = await Axios.post("auth/me");
		console.log(res);
		console.log();
		window.Echo.private(`App.User.${1}`).notification(notification => {
			console.log(notification);
		});
		// console.log(this.echo);
		// window.Echochannel("chat").listen(".chat", (e) => {
		// 	console.log("here I am! BEAT ME!!!!!!! I AM THE ERROR", e);
		// });
		// console.log();
	},
	beforeDestroy() {
		window.Echo.leave(`App.User.${1}`);
	}
};
</script>
