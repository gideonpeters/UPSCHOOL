<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="3">
					<metric-card title="Number of Rooms" :value="rooms.length" />
				</v-col>
				<v-col cols="3">
					<metric-card
						title="Total Capacity"
						:value="
							rooms.reduce((acc, val) => acc + val.capacity, 0)
						"
					/>
				</v-col>
				<v-col cols="12">
					<div class="d-flex">
						<v-spacer></v-spacer>
						<v-btn @click="dialogFull = true" depressed color="primary">CREATE NEW ROOM</v-btn>
					</div>
					<div class>
						<v-dialog v-model="dialogFull" fullscreen hide-overlay transition="dialog-bottom-transition">
							<v-card>
								<v-toolbar dark color="primary">
									<v-btn icon dark @click="dialogFull = false">
										<v-icon>mdi-close</v-icon>
									</v-btn>
									<v-toolbar-title>CREATE ROOM(S)</v-toolbar-title>
									<v-spacer></v-spacer>
									<v-toolbar-items>
										<v-btn
											dark
											text
											v-if="isBulk"
											:disabled="
												isBulk
													? !dummy || dummy.length < 0
													: null
											"
											@click="saveBulk"
										>Save</v-btn>
									</v-toolbar-items>
								</v-toolbar>

								<v-container>
									<v-checkbox label="Bulk Addition" v-model="isBulk"></v-checkbox>
								</v-container>

								<v-list three-line subheader v-if="!isBulk">
									<v-list-item>
										<v-list-item-content>
											<v-container>
												<v-list-item-title>Create Room</v-list-item-title>
												<v-row align="center">
													<v-col cols="6">
														<v-text-field outlined v-model="roomId" hint="e.g. F201" label="Room ID*"></v-text-field>
													</v-col>
													<v-col cols="6">
														<v-select
															:items="roomTypes"
															v-model="roomType"
															label="Room Type"
															outlined
															item-text="name"
															return-object
														/>
													</v-col>
													<v-col cols="6">
														<v-select
															:items="halls"
															v-model="hall"
															label="Hall"
															outlined
															item-text="name"
															return-object
														/>
													</v-col>
													<v-col cols="6">
														<v-text-field
															outlined
															v-model="
																roomDescription
															"
															label="Description (Optional)"
														></v-text-field>
													</v-col>
													<v-col cols="6">
														<v-text-field
															type="number"
															v-model="
																roomCapacity
															"
															hint="This value is required for room allocation, should be number of beds"
															outlined
															label="Capacity*"
														></v-text-field>
													</v-col>
													<v-col cols="6">
														<v-text-field v-model="roomWing" hint="Name of wing or block" outlined label="Wing*"></v-text-field>
													</v-col>

													<v-col class="d-flex" cols="12" sm="6">
														<v-select
															multiple
															clearable
															persistent-hint
															v-model="roomSex"
															:items="[
																'Male',
																'Female',
															]"
															return-value
															label="Preferred Sex to be allocated to this room"
															hint="If you select none, the room can be allocated to all options"
															outlined
														></v-select>
													</v-col>
													<v-col class="d-flex" cols="12" sm="6">
														<v-select
															multiple
															clearable
															v-model="roomLevel"
															persistent-hint
															:items="[
																'100',
																'200',
																'300',
																'400',
																'500',
															]"
															return-object
															label="Preferred Level to be allocated to this room"
															hint="If you select none, the room can be allocated to all options"
															outlined
														></v-select>
													</v-col>
													<v-col class="d-flex" cols="12" sm="6">
														<v-select
															multiple
															clearable
															v-model="
																roomNationality
															"
															persistent-hint
															:items="[
																'Nigerian',
																'International',
																'American',
																'Chinese',
																'Congolese',
																'Kenyan',
															]"
															label="Preferred Nationality to be allocated to this room"
															hint="If you select none, the room can be allocated to all options"
															outlined
														></v-select>
													</v-col>
													<v-col class="d-flex" cols="12" sm="6">
														<v-select
															multiple
															clearable
															v-model="
																roomProgram
															"
															persistent-hint
															:items="[
																'Computer Engineering',
																'Computer Science',
																'International Relations',
															]"
															label="Preferred Program to be allocated to this room (Optional)"
															hint="If you select none, the room can be allocated to all options"
															outlined
														></v-select>
													</v-col>
													<v-col class="d-flex" cols="12" sm="6">
														<v-select
															multiple
															clearable
															v-model="
																roomStudentType
															"
															:items="[
																'Undergraduate',
																'Postgraduate',
															]"
															persistent-hint
															label="Preferred Student type to be allocated to this room (Optional)"
															hint="If you select none, the room can be allocated to all options"
															outlined
														></v-select>
													</v-col>
													<v-col cols="12">
														<div class="d-flex">
															<v-spacer></v-spacer>
															<v-btn
																@click="
																	saveSingle
																"
																color="success"
																depressed
															>SAVE</v-btn>
														</div>
													</v-col>
												</v-row>
											</v-container>
										</v-list-item-content>
									</v-list-item>
								</v-list>
								<v-list three-line subheader v-if="isBulk">
									<v-list-item>
										<v-list-item-content>
											<v-container>
												<v-list-item-title>Add Halls (Bulk)</v-list-item-title>
												<v-row>
													<!-- <v-col cols="12">
													</v-col>-->
													<v-col cols="12" md="6">
														<v-btn
															class="my-5"
															tile
															outlined
															color="primary"
															text
															@click="
																downloadFormat
															"
														>Download format</v-btn>
														<v-file-input
															persistent-hint
															hint="make sure to download template before uploading file and upload with headers from template still present and unchanged in position"
															prepend-icon
															prepend-inner-icon="mdi-paperclip"
															outlined
															v-model="file"
															accept=".csv"
															@change="showCsv"
															label="Select csv file"
														></v-file-input>
														<div>
															<div
																class="fs-4 mt-5"
																v-if="
																	roomTypes.length >
																		0
																"
															>
																The Available
																Room Types are :
																<ul class="pt-2">
																	<li v-for="it in roomTypes" :key="
																			it.id
																		">
																		{{
																		it.name
																		}}
																	</li>
																</ul>
															</div>
															<div class="fs-4 mt-5" v-else>
																You have no room
																types specified;
																kindly leave
																that portion
																blank when
																uploading.
															</div>
														</div>
														<div>
															<div
																class="fs-4 mt-5"
																v-if="
																	roomTypes.length >
																		0
																"
															>
																The Available
																Halls are :
																<ul class="pt-2">
																	<li v-for="it in halls" :key="
																			it.id
																		">
																		{{
																		it.name
																		}}
																	</li>
																</ul>
															</div>
															<div class="fs-4 mt-5" v-else>
																You have no
																halls specified;
																kindly provide a
																hall to
																continue.
															</div>
														</div>
													</v-col>
													<v-col cols="12" md="6">
														<div>
															The required fields
															are:
															<ul class="mt-2">
																<li>Room ID</li>
																<li>Capacity</li>
																<li>Hall</li>
															</ul>
														</div>
														<div class="my-2">
															Fields beginning
															with "preferred" can
															take more than one
															value seperated by
															commas unless where
															specified. Note the
															following:
															<ul class="mt-2">
																<li>
																	Preferred
																	Levels can
																	take values
																	of
																	500,400,300,400,100;
																	leaving it
																	blank means
																	students of
																	any level
																	can be
																	allocated
																	the room
																</li>
																<li>
																	Preferred
																	Sex can take
																	values of
																	male,female;
																	leaving it
																	empty means
																	students of
																	any sex can
																	be allocated
																	this room
																</li>
																<li>
																	Preferred
																	Nationality
																	can take
																	values of
																	any
																	nationality
																	(e.g.
																	Nigerian,
																	American);
																	you may also
																	choose to
																	specify
																	local or
																	international
																	(not both);
																	leaving this
																	field empty
																	means this
																	room can be
																	allocated to
																	students of
																	any
																	nationality
																</li>
																<li>
																	Preferred
																	Student Type
																	can take
																	values of
																	postgraduate
																	or
																	undergraduate
																	(not both);
																	you can
																	specify
																	masters,bachelors,doctoral
																	for
																	specificity,
																	leaving it
																	blank means
																	students of
																	any type can
																	be allocated
																	this room
																</li>
																<li>
																	Preferred
																	Program can
																	take values
																	of the exact
																	program name
																	(it must be
																	the exact
																	name of the
																	program as
																	you saved
																	it) e.g.
																	Computer
																	Engineering,
																	Computer
																	Science;
																	leaving it
																	blank means
																	this room
																	can be
																	assigned to
																	students
																	from any
																	program
																</li>
															</ul>
														</div>
													</v-col>
													<v-col cols="12" md="12" v-if="dummy.length > 0">
														<v-card flat class="pa-3">
															<v-subheader class="pa-0">PREVIEW</v-subheader>
															<v-data-table
																:headers="
																	bulkHeaders
																"
																:items="dummy"
															></v-data-table>
														</v-card>
													</v-col>
												</v-row>
											</v-container>
										</v-list-item-content>
									</v-list-item>
								</v-list>
							</v-card>
						</v-dialog>
					</div>
				</v-col>
				<v-col cols="12">
					<v-card flat class="pa-3">
						<v-data-table :headers="headers" :items="rooms">
							<template v-slot:item.status="{ item: { status } }">
								<v-chip
									small
									class="white--text"
									:color="
										!status
											? 'green accent-3'
											: ' red accent-2'
									"
								>
									{{
									!status ? "Available" : "Unavailable"
									}}
								</v-chip>
							</template>
							<template v-slot:item.actions="{ item }">
								<div class="d-flex align-center justify-center">
									<v-btn
										color="grey"
										icon
										@click="
											goToPage(
												'parent.rooms.details',
												item.id
											)
										"
									>
										<v-icon small>mdi-eye</v-icon>
									</v-btn>
									<v-btn
										color="grey"
										icon
										@click="
											(selectedRoom = item),
												(dialogDelete = true)
										"
										v-if="isAdmin"
									>
										<v-icon small>mdi-delete</v-icon>
									</v-btn>
								</div>
							</template>
						</v-data-table>
					</v-card>
				</v-col>
			</v-row>
			<v-row>
				<v-dialog v-model="dialogDelete" persistent max-width="600px">
					<v-card>
						<v-card-title>
							<span class="headline">Confirm</span>
						</v-card-title>
						<v-card-text>
							<v-container>
								<v-row>
									<div class="fs-3" v-if="selectedRoom">
										Are you sure you want to delete this
										room ({{ selectedRoom.room_id }}:
										{{ selectedRoom.hall.name }})?
									</div>
								</v-row>
							</v-container>
						</v-card-text>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="blue darken-1" text @click="dialogDelete = false">Cancel</v-btn>
							<v-btn color="blue darken-1" text @click="deleteRoom(selectedRoom.id)">Proceed</v-btn>
						</v-card-actions>
					</v-card>
				</v-dialog>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
import Papa from "papaparse";
import Axios from "axios";
import { saveAs } from "file-saver";

export default {
	components: {
		MetricCard
	},
	data() {
		return {
			dialogFull: null,
			dialogDelete: null,
			isAdmin: true,
			isBulk: false,
			roomId: "",
			selectedRoom: null,
			roomCapacity: "",
			roomStudentType: "",
			roomNationality: "",
			roomProgram: "",
			roomSex: "",
			roomDescription: "",
			roomLevel: "",
			roomType: "",
			roomWing: "",
			bulkHeaders: [
				{ text: "ROOM ID", value: "room_id" },
				{ text: "CAPACITY", value: "capacity" },
				{ text: "HALL", value: "hall" },
				{ text: "ROOM TYPE", value: "room_type" },
				{ text: "WING", value: "wing" },
				{ text: "DESCRIPTION", value: "description" },
				{ text: "PREFERRED SEX", value: "preferred_sex" },
				{ text: "PREFERRED PROGRAM(S)", value: "preferred_program" },
				{
					text: "PREFERRED NATIONALITIES",
					value: "preferred_nationality"
				},
				{
					text: "PREFERRED STUDENT TYPE(S)",
					value: "preferred_student_type"
				},
				{ text: "PREFERRED LEVEL(S)", value: "preferred_level" }
			],
			headers: [
				{ text: "ROOM ID", value: "room_id", sortable: true },
				{ text: "WING/BLOCK", value: "wing", sortable: true },
				{ text: "HALL", value: "hall.name", sortable: true },
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
				{ text: "OCCUPANTS", value: "occupants_count", sortable: true },
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
			],
			rooms: [],
			dummy: [],
			roomTypes: [],
			halls: [],
			hall: "",
			file: [],
			bulkFile: ""
		};
	},
	computed: {
		csvData() {
			return [
				{
					room_id: "",
					room_type: "",
					capacity: "",
					wing: "",
					hall: "",
					description: "",
					preferred_sex: "",
					preferred_program: "",
					preferred_nationality: "",
					preferred_student_type: "",
					preferred_level: ""
				}
			];
		}
	},
	methods: {
		goToPage(routeName, id) {
			this.$router.push({ name: routeName, params: { id: id } });
		},
		showCsv(ent) {
			if (ent) {
				var reader = new FileReader();

				reader.readAsText(ent);
				reader.onload = async evt => {
					this.dummy = await Papa.parse(evt.target.result, {
						header: true,
						skipEmptyLines: true
					}).data;
					// console.log(this.dummy);
				};
			}
		},
		findItem(name, type) {
			name = name.trim().toLowerCase();
			let res = null;

			if (type == "hall") {
				res = this.halls.find(item => {
					let hallName = item.name.trim().toLowerCase();
					return name == hallName;
				});
			} else if (type == "room-type") {
				res = this.roomTypes.find(item => {
					let hallName = item.name.trim().toLowerCase();
					return name == hallName;
				});
			}

			return res ? res : null;
		},
		async saveBulk() {
			try {
				// console.log(this.findItem("danieel hall ", "hall"));
				if (this.dummy.length > 0) {
					let items = this.dummy.map(item => ({
						// ...item,
						room_id: item.room_id,
						description: item.description,
						wing: item.wing,
						capacity: item.capacity ? item.capacity : 0,
						hall_id: this.findItem(item.hall, "hall").id || null,
						room_type_id:
							this.findItem(item.room_type, "room-type").id ||
							null,
						preferred_sex: item.preferred_sex
							? JSON.stringify(item.preferred_sex.split(","))
							: null,
						preferred_program: item.preferred_program
							? JSON.stringify(item.preferred_program.split(","))
							: null,
						preferred_nationality: item.preferred_nationality
							? JSON.stringify(
									item.preferred_nationality.split(",")
							  )
							: null,
						preferred_student_type: item.preferred_student_type
							? JSON.stringify(
									item.preferred_student_type.split(",")
							  )
							: null,
						preferred_level: item.preferred_level
							? JSON.stringify(item.preferred_level.split(","))
							: null
					}));

					let res = await Axios.post("room-bulk", {
						data: JSON.stringify(items)
					});
					console.log(res.data);
					this.$store.commit("openSnackbar", res.data.message);
					this.getRooms();
					this.dummy = [];
					this.isBulk = false;
					this.dialogFull = false;
				}
			} catch (error) {
				console.log(error);
			}
		},
		async deleteRoom(id) {
			try {
				let res = await Axios.delete(`room/${id}`);
				this.$store.commit("openSnackbar", res.data.message);
				this.getRooms();
				this.dialogDelete = false;
				this.selectedRoom = null;
			} catch (error) {
				console.log(error);
			}
		},
		async downloadFormat() {
			var csv = await Papa.unparse(this.csvData);

			var csvData = new File([csv], "room_template.csv", {
				type: "text/csv;charset=utf-8"
			});

			saveAs(csvData);
		},
		async getHalls() {
			try {
				let res = await Axios.get("hall");
				console.log(res.data);
				this.halls = res.data.data;
			} catch (error) {
				console.log(error);
			}
		},
		async saveSingle() {
			try {
				// console.log(this.roomSex);
				let body = {
					room_id: this.roomId,
					hall_id: this.hall.id,
					room_type_id: this.roomType.id,
					wing: this.roomWing,
					description: this.roomDescription,
					capacity: this.roomCapacity,
					preferred_sex: this.roomSex
						? JSON.stringify(this.roomSex)
						: null,
					preferred_program: this.roomProgram
						? JSON.stringify(this.roomProgram)
						: null,
					preferred_nationality: this.roomNationality
						? JSON.stringify(this.roomNationality)
						: null,
					preferred_student_type: this.roomStudentType
						? JSON.stringify(this.roomStudentType)
						: null,
					preferred_level: this.roomLevel
						? JSON.stringify(this.roomLevel)
						: null
				};
				// console.log(body);
				let res = await Axios.post("room", body);
				this.getRooms();
				this.$store.commit("openSnackbar", res.data.message);

				console.log(res.data);
				this.dialogFull = false;
				this.roomId = "";
				this.roomStudentType = "";
				this.roomNationality = "";
				this.roomProgram = "";
				this.roomCapacity = "";
				this.roomSex = "";
				this.roomDescription = "";
				this.roomLevel = "";
				this.roomType = "";
			} catch (error) {
				console.log(error);
			}
		},
		async getRoomTypes() {
			try {
				let res = await Axios.get("roomtype");

				this.roomTypes = res.data.data;

				// this.$store.commit("openSnackbar", res.data.message);
			} catch (error) {
				console.log(error);
			}
		},
		async getRooms() {
			try {
				let res = await Axios.get("room");

				console.log(res.data);
				this.rooms = res.data.data;

				// this.$store.commit("openSnackbar", res.data.message);
			} catch (error) {
				console.log(error);
			}
		}
	},
	async mounted() {
		try {
			this.getRooms();
			this.getRoomTypes();
			this.getHalls();
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
