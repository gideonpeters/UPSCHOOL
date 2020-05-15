<template>
	<v-app>
		<main>
			<router-view />
			<v-snackbar v-model="snackbar.isActive" :timeout="snackbar.timeout">
				{{ snackbar.text }}
				<v-btn color="blue" text @click="closeSnackbar">Close</v-btn>
			</v-snackbar>
			<v-tour name="studentTour" :steps="steprs" />
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
		steprs: [],
		steps: [
			{
				target: '[data-v-step="0"]',
				content:
					"Hi! I'm just going to put you through a few things so you're on your way to conquering this app!",
				params: {
					placement: "bottom",
					highlight: false
				}
			},
			{
				target: '[data-v-step="1"]',
				content: "These are all the events you have lined up for today",
				params: {
					placement: "auto",
					highlight: false
				}
			},
			{
				target: '[data-v-step="2"]',
				content:
					"These are all the submissions you have not attended to. Hurry! Some may be due soon.",
				params: {
					placement: "bottom",
					highlight: false
				}
			}
		]
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
	},
	mounted() {
		this.$tours["studentTour"].start();
	}
};
</script>
