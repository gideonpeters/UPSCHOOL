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
	}
};
</script>
