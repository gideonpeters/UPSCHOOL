<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="12">
					<div class="d-flex align-center">
						<v-btn icon color="grey" @click="goBack">
							<v-icon>mdi-arrow-left</v-icon>
						</v-btn>
						{{ room.room_id }} : {{ hall }}
					</div>
				</v-col>

				<v-col cols="12">
					<div>
						<v-card flat class="pa-3 mt-5">
							<v-tabs v-model="tab" background-color="transparent">
								<v-tab :to="{name: tab.route}" v-for="tab in tabs" :key="tab.id">{{ tab.title }}</v-tab>
							</v-tabs>
							<router-view></router-view>
						</v-card>
					</div>
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
			tab: null,
			room: {},
			tabs: [
				{
					id: 1,
					title: "Overview",
					route: "parent.rooms.details"
				},
				{
					id: 2,
					title: "Occupancy",
					route: "parent.rooms.details.occupancy"
				},
				{ id: 3, title: "Issues", route: "parent.rooms.details.issues" }
			]
		};
	},
	computed: {
		hall() {
			if (this.room.hall) {
				return this.room.hall.name || "";
			}
			return "";
		}
	},
	methods: {
		goBack() {
			this.$router.push({ name: "parent.rooms" });
		}
	},
	async mounted() {
		try {
			let id = this.$route.params.id;
			let res = await Axios.get(`room/${id}`);

			console.log(res.data);

			this.room = res.data.data;
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
