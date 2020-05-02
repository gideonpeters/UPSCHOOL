<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="12" v-if="currentRoom.length == 0 && !isAllocating">
					<v-btn
						color="primary"
						tile
						outlined
						@click="isAllocating = true, getAvailableRooms()"
					>GET ALLOCATION</v-btn>
				</v-col>
				<v-col cols="12" v-if="isAllocating">
					<v-btn color="primary" tile outlined @click="isAllocating = false, selectedRoom = []">CANCEL</v-btn>
				</v-col>
				<v-col cols="12" v-if="!isAllocating">
					<v-card class="pa-3">
						<v-subheader>CURRENT ALLOCATION</v-subheader>
						<v-data-table :headers="currentHeaders" :items="currentRoom" hide-default-footer>
							<template v-slot:no-data>
								<div>You have not been allocated a room</div>
							</template>
							<template v-slot:item.status="{item}">
								<v-chip
									:color="item.room.status ? 'red accent-3' : 'green accent-4'"
									small
									class="text-uppercase white--text"
								>{{item.room.status ? 'Unavailable' : 'Available'}}</v-chip>
							</template>
							<template v-slot:item.actions="{ item }">
								<div class="d-flex align-center justify-center">
									<v-btn color="grey" icon @click="dialogRoom = true, currentSelection = item">
										<v-icon small>mdi-eye</v-icon>
									</v-btn>
								</div>
							</template>
						</v-data-table>
					</v-card>
				</v-col>
				<v-col cols="12" v-else>
					<v-card class="pa-3">
						<div class="d-flex">
							<v-subheader>AVAILABLE ROOMS</v-subheader>
							<v-spacer></v-spacer>
							<v-btn
								v-if="selectedRoom.length > 0"
								color="primary"
								tile
								text
								@click="getAllocation"
							>GET ROOM</v-btn>
						</div>
						<v-data-table
							v-model="selectedRoom"
							show-select
							single-select
							:headers="headers"
							:items="items"
						>
							<template v-slot:item.wing="{item}">
								<div class="text-uppercase">{{item.wing}}</div>
							</template>
							<template v-slot:item.hall="{item}">
								<div class="text-uppercase">{{item.hall.name}}</div>
							</template>
							<template v-slot:item.status="{item}">
								<v-chip
									:color="item.status ? 'red accent-3' : 'green accent-4'"
									small
									class="text-uppercase white--text"
								>{{item.status ? 'Unavailable' : 'Available'}}</v-chip>
							</template>
							<template v-slot:item.actions="{ item }">
								<div class="d-flex align-center justify-center">
									<v-btn color="grey" icon @click="dialog = true, currentSelection = item">
										<v-icon small>mdi-eye</v-icon>
									</v-btn>
								</div>
							</template>
						</v-data-table>
					</v-card>
				</v-col>
			</v-row>
			<v-dialog v-model="dialog" persistent max-width="900px">
				<v-card v-if="currentSelection.hall">
					<v-card-title>
						<span
							class="headline text-uppercase"
						>{{currentSelection.room_id}}: {{currentSelection.hall.name}}</span>
					</v-card-title>
					<v-card-text>
						<v-container>
							<v-row>
								<v-col cols="12" sm="6" md="12">
									<v-card flat>
										<div class="d-flex">
											<div>ROOM TYPE:</div>
											<div class="mx-4">{{currentSelection.room_type.name}}</div>
										</div>
										<div class="d-flex my-4">
											<div>WING:</div>
											<div class="mx-4">{{currentSelection.wing}}</div>
										</div>
										<div class="d-flex mb-5">
											<div>DESCRIPTION:</div>
											<div class="mx-4">{{currentSelection.description}}</div>
										</div>
										<v-card class="pa-3 mt-5">
											<v-subheader>OCCUPANTS</v-subheader>
											<v-data-table
												hide-default-footer
												:headers="allOccupantsHeaders"
												:items="currentSelection.occupants"
											></v-data-table>
										</v-card>
									</v-card>
								</v-col>
							</v-row>
						</v-container>
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
						<v-btn color="blue darken-1" text @click="dialog = false">Save</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>

			<v-dialog v-model="dialogRoom" persistent max-width="900px">
				<v-card>
					<v-card-title>
						<span
							class="headline text-uppercase"
							v-if="currentSelection.room"
						>{{currentSelection.room.room_id}}: {{currentSelection.room.hall.name}}</span>
					</v-card-title>
					<v-card-text>
						<v-container>
							<v-row>
								<v-col cols="12" sm="6" md="12">
									<v-card flat v-if="currentSelection.room">
										<div class="d-flex">
											<div>ROOM TYPE:</div>
											<div class="mx-4">{{currentSelection.room.room_type.name}}</div>
										</div>
										<div class="d-flex my-4">
											<div>WING:</div>
											<div class="mx-4">{{ currentSelection.room.wing }}</div>
										</div>
										<div class="d-flex mb-5">
											<div>DESCRIPTION:</div>
											<div class="mx-4">{{currentSelection.room.description}}</div>
										</div>
										<v-card class="pa-3 mt-5">
											<v-subheader>ROOM MATES</v-subheader>
											<v-data-table
												hide-default-footer
												:headers="occupantsHeaders"
												:items="currentSelection.room_mates"
											></v-data-table>
										</v-card>
									</v-card>
								</v-col>
							</v-row>
						</v-container>
					</v-card-text>
					<v-card-actions>
						<v-spacer></v-spacer>
						<v-btn color="blue darken-1" text @click="dialogRoom = false">Close</v-btn>
						<v-btn color="blue darken-1" text @click="dialogRoom = false">Save</v-btn>
					</v-card-actions>
				</v-card>
			</v-dialog>
		</v-container>
	</v-app>
</template>

<script>
import Axios from "axios";
export default {
	data() {
		return {
			settings: {},
			currentSelection: {},
			selectedRoom: [],
			dialog: null,
			dialogRoom: null,
			isAllocating: false,
			currentRoom: [],
			headers: [
				{ text: "ROOM ID", value: "room_id", sortable: true },
				{ text: "WING/BLOCK", value: "wing", sortable: true },
				{ text: "HALL", value: "hall", sortable: true },
				{
					text: "CAPACITY",
					value: "capacity",
					sortable: true,
					align: "center"
				},
				{
					text: "STATUS",
					value: "status",
					sortable: true,
					align: "center"
				},
				{
					text: "OCCUPANTS",
					value: "occupants_count",
					sortable: true,
					align: "center"
				},
				{
					text: "ACTIONS",
					value: "actions",
					sortable: true,
					align: "center"
				}
			],
			currentHeaders: [
				{ text: "ROOM ID", value: "room.room_id", sortable: true },
				{ text: "WING/BLOCK", value: "room.wing", sortable: true },
				{ text: "HALL", value: "room.hall.name", sortable: true },
				{
					text: "CAPACITY",
					value: "room.capacity",
					sortable: true,
					align: "center"
				},
				{
					text: "STATUS",
					value: "status",
					sortable: true,
					align: "center"
				},
				{
					text: "OCCUPANTS",
					value: "room.occupants_count",
					sortable: true,
					align: "center"
				},
				{
					text: "ACTIONS",
					value: "actions",
					sortable: true,
					align: "center"
				}
			],
			occupantsHeaders: [
				{ text: "NAME", value: "student.name" },
				{ text: "MATRIC NUMBER", value: "student.matric_number" },
				{
					text: "PROGRAM",
					value: "student.program.name"
				},
				{ text: "Level", value: "student.level" }
			],
			allOccupantsHeaders: [
				{ text: "NAME", value: "name" },
				{ text: "MATRIC NUMBER", value: "matric_number" },
				{
					text: "PROGRAM",
					value: "program.name"
				},
				{ text: "Level", value: "level" }
			],
			items: []
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
		},
		async getRoom() {
			try {
				let body = { room_id: this.selectedRoom.id };

				let res = await Axios.post("room-allocate", body);
				console.log(res.data);
				this.$store.commit("openSnackbar", res.data.message);
			} catch (error) {
				console.log(error);
			}
		},
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
		},
		async getAvailableRooms() {
			try {
				let id = this.$store.state.loggedInUser.id;

				let res = await Axios.get(
					`room?status=available&student_id=${id}`
				);
				if (res.data.status) {
					this.items = res.data.data;
				}

				console.log(res.data);
			} catch (error) {
				console.log(error);
			}
		},
		async getAllocation() {
			try {
				let id = this.$store.state.loggedInUser.id;

				let res = await Axios.post("room-allocation", {
					room_id: this.selectedRoom[0].id,
					student_id: id
				});

				console.log(res.data);
				this.selectedRoom = {};
				this.getCurrentRoom();
				this.isAllocating = false;

				this.$store.commit("openSnackbar", res.data.message);
			} catch (error) {
				console.log(error);
			}
		}
	},
	async mounted() {
		try {
			this.getSettings();
			// let res = await this.$store.dispatch("getUser");
			// console.log(res);
			this.getCurrentRoom();

			// if (!this.currentRoom.room_id) {
			// 	this.getAvailableRooms();
			// }
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
