<template>
	<v-app>
		<dashboard isStudent />
	</v-app>
</template>

<script>
import Dashboard from "@/components/general/Dashboard";

export default {
	components: {
		Dashboard
	},
	async mounted() {
		try {
			await this.$store.dispatch("getUser");
		} catch (error) {
			console.log(error);
		}
	}
};
</script>