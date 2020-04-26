<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="3">
					<metric-card title="Number of Halls" :value="10" />
				</v-col>
				<v-col cols="3">
					<metric-card title="Total Capacity" :value="1500" />
				</v-col>
				<v-col cols="12">
					<v-card flat class="pa-3">
						<v-data-table :headers="headers" :items="items">
							<template v-slot:item.actions="{item}">
								<div class="d-flex align-center justify-center">
									<v-btn color="grey" icon @click="goToPage('parent.rooms.details', item.id)">
										<v-icon small>mdi-eye</v-icon>
									</v-btn>
									<v-btn color="grey" icon>
										<v-icon small>mdi-delete</v-icon>
									</v-btn>
								</div>
							</template>
						</v-data-table>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
export default {
	components: {
		MetricCard
	},
	data() {
		return {
			headers: [
				{ text: "ROOM ID", value: "room_id", sortable: true },
				{ text: "WING/BLOCK", value: "wing.name", sortable: true },
				{ text: "HALL", value: "hall.name", sortable: true },
				{ text: "CAPACITY", value: "capacity", sortable: true },
				{ text: "STATUS", value: "status", sortable: true },
				{ text: "OCCUPANTS", value: "occupants", sortable: true },
				{
					text: "ACTIONS",
					value: "actions",
					sortable: true,
					align: "center"
				}
			],
			items: [
				{
					id: 1,
					room_id: "A100",
					wing: {
						id: 1,
						name: "A WING"
					},
					capacity: 4,
					status: "Available",
					room_type: "Standard",
					occupants: 2,
					hall: {
						id: 1,
						name: "Esther Hall",
						sex: "female"
					},
					sex: "female"
				},
				{
					id: 2,
					room_id: "B100",
					wing: {
						id: 1,
						name: "B WING"
					},
					hall: {
						id: 1,
						name: "Daniel Hall",
						sex: "male"
					},
					capacity: 4,
					status: "Available",
					room_type: "Standard",
					occupants: 1,
					sex: "male"
				}
			]
		};
	},
	methods: {
		goToPage(routeName, id) {
			this.$router.push({ name: routeName, params: { id: id } });
		}
	}
};
</script>
