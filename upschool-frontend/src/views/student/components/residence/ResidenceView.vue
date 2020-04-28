<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="12">
					<v-btn color="primary" tile outlined>GET ALLOCATION</v-btn>
				</v-col>
				<v-col cols="12">
					<v-card class="pa-3">
						<v-subheader>CURRENT ALLOCATION</v-subheader>
						<v-data-table :headers="[]" :items="[]"></v-data-table>
					</v-card>
				</v-col>
				<v-col cols="12">
					<v-card class="pa-3">
						<v-subheader>AVAILABLE ROOMS</v-subheader>
						<v-data-table :headers="[]" :items="[]"></v-data-table>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import Axios from "axios";
export default {
	data() {
		return {
			settings: {}
		};
	},
	methods: {
		async getSettings() {
			try {
				let res = await Axios.get("allocation-settings");
				console.log(res.data);
				this.settings = res.data.data;
			} catch (error) {
				console.log(error);
			}
		}
	},
	async mounted() {
		try {
			this.getSettings();
			let res = await Axios.get("room?status=available");
			console.log(res.data);
		} catch (error) {
			console.log(error);
		}
	}
};
</script>