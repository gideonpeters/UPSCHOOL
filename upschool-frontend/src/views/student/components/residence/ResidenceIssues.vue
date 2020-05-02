<template>
	<v-app>
		<issues isStudent :currentRoom="currentRoom[0]" />
	</v-app>
</template>

<script>
import Issues from "@/components/general/room-view/Issues";
import Axios from "axios";
export default {
	components: {
		Issues
	},
	data() {
		return {
			currentRoom: []
		};
	},
	methods: {
		async getCurrentRoom() {
			try {
				let id = this.$store.state.loggedInUser.id;

				let res = await Axios.get(`room-current?student_id=${id}`);

				console.log(res.data);
				if (res.data.status) {
					this.currentRoom = [...this.currentRoom, res.data.data];
				}
			} catch (error) {
				console.log(error);
			}
		}
	},
	async mounted() {
		try {
			// if (this.isStudent) {
			this.getCurrentRoom();
			// }
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
