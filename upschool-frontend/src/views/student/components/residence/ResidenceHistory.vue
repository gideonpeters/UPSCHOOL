<template>
	<v-app>
		<h1>History</h1>
	</v-app>
</template>

<script>
import Axios from "axios";
export default {
	async mounted() {
		try {
			let id = this.$store.state.loggedInUser.id;
			let res = await Axios.get(`room-allocation?student_id=${id}`);
			console.log(res.data);
		} catch (error) {
			console.log(error);
		}
	}
};
</script>