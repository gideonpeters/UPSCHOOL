<template>
	<v-app>
		<main>
			<router-view />
			<v-snackbar v-model="snackbar.isActive" :timeout="snackbar.timeout">
				{{ snackbar.text }}
				<v-btn color="blue" text @click="closeSnackbar">Close</v-btn>
			</v-snackbar>
		</main>
	</v-app>
</template>

<script>
// import ApolloExample from './components/ApolloExample';
import axios from "axios";

export default {
	name: "App",
	data: () => ({
		//
	}),
	computed: {
		snackbar() {
			return this.$store.getters.snackbar;
		}
	},
	methods: {
		closeSnackbar() {
			return this.$store.commit("close-snackbar");
		}
	},
	created: function() {
		axios.interceptors.response.use(undefined, function(err) {
			return new Promise(function(resolve, reject) {
				if (
					err.status === 401 &&
					err.config &&
					!err.config.__isRetryRequest
				) {
					// if you ever get an unauthorized, logout the user
					this.$store.dispatch("AUTH_LOGOUT");
					// you can also redirect to /login if needed !
				}
				throw err;
			});
		});
	}
};
</script>
