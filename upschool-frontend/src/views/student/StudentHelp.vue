<template>
	<v-app>help</v-app>
</template>

<script>
export default {
	async mounted() {
		this.$store.dispatch('testEcho')
		// console.log(this.echo);
		this.echo.channel("chat").listen("chat", (e) => {
			console.log("here I am! BEAT ME!!!!!!! I AM THE ERROR", e);
		});
		// console.log();
	},
};
</script>
