<template>
	<v-app>
		<v-card flat>
			<v-container>
				<v-row>
					<v-col cols="3">
						<metric-card
							title="Number of pending applications"
							:value="exeats.filter(val => val.status == 'pending').length"
						/>
					</v-col>
					<v-col cols="3">
						<metric-card
							title="Number of due applications"
							:value="exeats.filter(val => val.status == 'due').length"
						/>
					</v-col>
					<v-col cols="3">
						<metric-card title="Number of applications" :value="exeats.length" />
					</v-col>
					<v-col cols="12" sm="6" md="4">
						<v-text-field
							v-model="search"
							append-icon="mdi-magnify"
							label="Search"
							single-line
							flat
							outlined
							hide-details
						></v-text-field>
					</v-col>
					<v-col cols="12">
						<v-card class="mt-4 pa-3" flat>
							<v-subheader class="d-flex mb-4 mr-4">
								<v-spacer></v-spacer>
								<v-icon size="18">mdi-filter</v-icon>
								<div>Filter</div>
							</v-subheader>
							<v-data-table
								:headers="headers"
								:items="exeats"
								:search="search"
								sort-by="status"
								class="elevation-1"
							>
								<template v-slot:item.status="{ item }">
									<v-chip :color="getStatus(item.status)" small dark class="text-uppercase">{{ item.status }}</v-chip>
								</template>
								<template v-slot:item.action="{ item }">
									<div class="d-flex flex-column">
										<v-btn icon color="grey" @click="showItem(item)">
											<v-icon small color="grey">mdi-eye</v-icon>
										</v-btn>
										<v-btn icon color="grey" @click="editItem(item)">
											<v-icon small>mdi-pencil</v-icon>
										</v-btn>
										<v-btn icon color="grey" @click="deleteItem(item)">
											<v-icon small>mdi-delete</v-icon>
										</v-btn>
									</div>
								</template>
								<template v-slot:no-data>No data available</template>
							</v-data-table>
						</v-card>
					</v-col>
					<v-col>
						<v-dialog v-model="dialog3" persistent max-width="600px">
							<v-card>
								<v-card-title>
									<span class="headline">APPLY FOR EXEAT</span>
								</v-card-title>
								<v-card-text>
									<v-container>
										<v-row>
											<v-col cols="12">
												<v-select
													return-object
													item-text="name"
													:value="selectedExeat.exeat_type"
													v-model="selectedExeatType"
													outlined
													label="Select Type*"
													:items="exeatTypes"
												></v-select>
											</v-col>
											<v-col cols="12">
												<v-textarea :value="'yooy'" v-model="reason" outlined rows="10" label="Reason"></v-textarea>
											</v-col>
											<v-col cols="11" sm="6">
												<v-menu
													ref="menuDepartureTime"
													v-model="menuDepartureTime"
													:close-on-content-click="false"
													:nudge-right="40"
													:return-value.sync="departureTime"
													transition="scale-transition"
													offset-y
													max-width="290px"
													min-width="290px"
												>
													<template v-slot:activator="{ on }">
														<v-text-field
															outlined
															v-model="departureTime"
															label="Departure Time*"
															prepend-inner-icon="mdi-clock"
															readonly
															v-on="on"
														></v-text-field>
													</template>
													<v-time-picker
														v-if="menuDepartureTime"
														v-model="departureTime"
														full-width
														@click:minute="$refs.menuDepartureTime.save(departureTime)"
													></v-time-picker>
												</v-menu>
											</v-col>
											<v-col cols="12" sm="6" md="6">
												<v-dialog
													ref="dialogDepartureDate"
													v-model="modalDepartureDate"
													:return-value.sync="departureDate"
													persistent
													width="290px"
												>
													<template v-slot:activator="{ on }">
														<v-text-field
															outlined
															v-model="departureDate"
															label="Departure Date*"
															prepend-inner-icon="mdi-calendar"
															readonly
															v-on="on"
														></v-text-field>
													</template>
													<v-date-picker v-model="departureDate" scrollable>
														<v-spacer></v-spacer>
														<v-btn text color="primary" @click="modalDepartureDate = false">Cancel</v-btn>
														<v-btn text color="primary" @click="$refs.dialogDepartureDate.save(departureDate)">OK</v-btn>
													</v-date-picker>
												</v-dialog>
											</v-col>
											<v-col cols="12">
												<v-file-input
													:rules="rules"
													prepend-inner-icon="mdi-paperclip"
													prepend-icon
													show-size
													outlined
													multiple
													v-model="files"
													accept="image/*"
													label="Add attachments"
												></v-file-input>
											</v-col>
										</v-row>
									</v-container>
									<small>
										*indicates required
										field
									</small>
								</v-card-text>
								<v-card-actions>
									<v-spacer></v-spacer>
									<v-btn color="error darken-1" outlined text @click="clear">Cancel</v-btn>
									<v-btn color="success darken-1" depressed @click="submitExeat">Submit</v-btn>
								</v-card-actions>
							</v-card>
						</v-dialog>
						<v-dialog v-model="dialog4" max-width="600px">
							<v-card>
								<v-card-title>{{selectedExeat.exeat_id}}</v-card-title>
								<v-card-text>
									<v-container>
										<v-row>
											<v-col>
												<div>
													<div class="font-weight-bold fs-4">EXEAT TYPE</div>
													<div
														v-if="selectedExeat.exeat_type"
														class="text-capitalize"
													>{{selectedExeat.exeat_type.name}}</div>
												</div>

												<div class="my-4">
													<div class="font-weight-bold fs-4">DURATION</div>
													<div
														v-if="selectedExeat.exeat_type"
														class="text-capitalize"
													>{{selectedExeat.exeat_type.duration}} {{selectedExeat.exeat_type.metric}}</div>
												</div>

												<div class="mb-4 d-flex align-center">
													<div class="font-weight-bold fs-4 mr-5">STATUS:</div>
													<v-chip
														:color="getStatus(selectedExeat.status)"
														small
														class="white--text text-uppercase"
													>{{selectedExeat.status}}</v-chip>
												</div>

												<div class="mb-4">
													<div class="font-weight-bold fs-4">REASON</div>
													<div v-text="selectedExeat.reason"></div>
												</div>

												<div class="mb-4">
													<div class="font-weight-bold fs-4">PHONE NUMBER</div>
													<div>+2347089324817</div>
												</div>

												<div class="mb-4">
													<div class="font-weight-bold fs-4">GUARDIAN'S PHONE NUMBER</div>
													<div>+2347089324817</div>
													<div>+2348035050175</div>
												</div>

												<div class="mb-4">
													<div class="font-weight-bold fs-4">REQUESTED DEPARTURE DATETIME</div>
													<div>{{moment(selectedExeat.requested_departure).format("LLL")}}</div>
												</div>

												<div class="mb-4">
													<div class="font-weight-bold fs-4">EXPECTED DEPARTURE DATETIME</div>
													<div>{{moment(selectedExeat.expected_arrival).format("LLL")}}</div>
												</div>

												<div class="mb-4">
													<div class="font-weight-bold fs-4">DATE/TIME OF DEPARTURE</div>
													<div>8:00 AM 22nd March, 2020</div>
												</div>

												<div class="mb-4">
													<div class="font-weight-bold fs-4">DATE/TIME OF ARRIVAL</div>
													<div>8:00 AM 25th March, 2020</div>
												</div>

												<div class="mb-4" v-if="selectedExeat.status == 'approved'">
													<div class="font-weight-bold fs-4">PROGRESS</div>
													<div>
														<v-progress-linear value="15"></v-progress-linear>
													</div>
												</div>

												<div class="mb-4" v-if="selectedExeat.file && selectedExeat.file.length > 0">
													<div class="font-weight-bold fs-4 mb-2">ATTACHMENTS</div>
													<v-chip
														@click="goTo(file.url)"
														class="mr-2 pointer"
														v-for="file in selectedExeat.file"
														:key="file.id"
													>{{file.name}}</v-chip>
												</div>

												<div class="d-flex justify-end">
													<v-dialog
														v-model="dialog5"
														persistent
														max-width="290"
														v-if="selectedExeat.status == 'pending' || selectedExeat.status == 'approved'"
													>
														<template v-slot:activator="{ on }">
															<v-btn depressed outlined color="red accent-2" v-on="on">DECLINE</v-btn>
															<!-- <v-btn color="primary" dark v-on="on">Open Dialog</v-btn> -->
														</template>
														<v-card>
															<v-card-title class="headline">DECLINE LEAVE?</v-card-title>
															<v-card-text>
																Are you sure you are ready to
																decline this exeat and that it meets
																all the school's policies regarding
																this.
																<div class="mt-3">
																	<div class="fs-4 font-weight-bold">REMARKS</div>
																	<v-row>
																		<v-col cols="12">
																			<textarea
																				outlined
																				label="Outlined textarea"
																				placeholder="Type here"
																				name="remarks"
																			></textarea>
																		</v-col>
																	</v-row>
																</div>
															</v-card-text>
															<v-card-actions>
																<v-spacer></v-spacer>
																<v-btn color="green darken-1" text @click="dialog5 = false">Disagree</v-btn>
																<v-btn
																	color="green darken-1"
																	text
																	@click="dialog5 = false, respondToExeat(false, selectedExeat.id)"
																>Agree</v-btn>
															</v-card-actions>
														</v-card>
													</v-dialog>
													<v-dialog
														v-model="dialog6"
														persistent
														max-width="290"
														v-if="selectedExeat.status == 'pending' || selectedExeat.status == 'declined'"
													>
														<template v-slot:activator="{ on }">
															<v-btn depressed color="green accent-4" class="white--text ml-2" v-on="on">APPROVE</v-btn>
															<!-- <v-btn color="primary" dark v-on="on">Open Dialog</v-btn> -->
														</template>
														<v-card>
															<v-card-title class="headline">APPROVE LEAVE?</v-card-title>
															<v-card-text>
																Are you sure you are ready to
																approve this exeat and that it meets
																all the school's policies regarding
																this.
																<div class="mt-3">
																	<div class="fs-4 font-weight-bold">REMARKS</div>
																	<v-row>
																		<v-col cols="12">
																			<textarea
																				outlined
																				label="Outlined textarea"
																				placeholder="Type here"
																				name="remarks"
																			></textarea>
																		</v-col>
																	</v-row>
																</div>
															</v-card-text>
															<v-card-actions>
																<v-spacer></v-spacer>
																<v-btn color="green darken-1" text @click="dialog6 = false">Disagree</v-btn>
																<v-btn
																	color="green darken-1"
																	text
																	@click="dialog6 = false, respondToExeat(true, selectedExeat.id)"
																>Agree</v-btn>
															</v-card-actions>
														</v-card>
													</v-dialog>
												</div>
											</v-col>
										</v-row>
									</v-container>
								</v-card-text>
							</v-card>
						</v-dialog>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
	</v-app>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
import Axios from "axios";
export default {
	components: {
		MetricCard
	},
	data() {
		return {
			search: "",
			dialog: false,
			dialog3: false,
			dialog4: false,
			dialog5: false,
			dialog6: false,
			selectedExeatType: {},
			selectedExeat: {},
			menuDepartureTime: null,
			departureTime: null,
			modalDepartureDate: null,
			departureDate: null,
			exeatTypes: [],
			files: [],
			reason: "",
			rules: [
				value =>
					!value ||
					value.size < 2000000 ||
					"Cover image size should be less than 2 MB!"
			],
			headers: [
				{
					text: "Name",
					align: "left",
					sortable: false,
					value: "student.name"
				},
				{
					text: "Matriculation Number",
					value: "student.matric_number"
				},
				{ text: "Type", value: "exeat_type.name" },
				{ text: "Grade/Level", value: "student.level" },
				{ text: "Program", value: "student.program.name" },
				{ text: "Status", value: "status" },
				{ text: "Residence", value: "latest_room.room.hall.name" },
				{
					text: "Actions",
					value: "action",
					sortable: false,
					align: "center"
				}
			],
			exeats: []
		};
	},
	async mounted() {
		try {
			this.getExeats();
			this.getExeatTypes();
		} catch (error) {
			throw error;
		}
	},
	watch: {
		dialog(val) {
			val || this.close();
		}
	},
	methods: {
		editItem(item) {
			this.editedIndex = this.desserts.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},

		deleteItem(item) {
			const index = this.desserts.indexOf(item);
			confirm("Are you sure you want to delete this item?") &&
				this.desserts.splice(index, 1);
		},

		goToPage(v) {
			// console.log(v);
			this.$router.push({
				name: "parent.exeat.details",
				params: { id: v.id }
			});
		},
		showItem(item) {
			this.selectedExeat = item;
			// this.reason = item.reason;
			// this.selectedExeatType = item.exeat_type;
			// this.departureTime =
			this.dialog4 = true;
		},

		getColor(status) {
			if (status == 1) return "green accent-3";
			else if (status == 2) return "orange accent-2";
			else if (status == 3) return "red accent-2";
			else return "red";
		},
		getStatus(val) {
			let res;
			switch (val) {
				case "pending":
					res = "yellow accent-4";
					break;
				case "approved":
					res = "green accent-2";
					break;
				case "declined":
					res = "red accent-2";
					break;

				default:
					res = "yellow accent-2";
					break;
			}
			return res;
		},
		async submitExeat() {
			try {
				var body = new FormData();
				body.append("student_id", this.$store.state.loggedInUser.id);
				body.append("reason", this.reason);
				body.append("exeat_type_id", this.selectedExeatType.id);
				body.append(
					"requested_departure",
					`${this.departureDate}T${this.departureTime}:00`
				);

				for (let index = 0; index < this.files.length; index++) {
					body.append(`files[]`, this.files[index]);
				}

				// console.log(...body);
				let res = await Axios.post("exeat", body);
				this.$store.commit("openSnackbar", res.data.message);
				console.table(res.data);
				if (res.data.status) {
					this.getExeats().then(() => (this.isLoading = false));
				}
				// this.exeatTypes = res.data.data;
			} catch (error) {
				throw error;
			}
		},
		async respondToExeat(val = false, id) {
			try {
				let res = await Axios.post(`exeat?action=${val}`, {
					status: val,
					exeat_id: id
				});
				this.$store.commit("openSnackbar", res.data.message);
				this.dialog4 = false;
				this.dialog5 = false;
				this.dialog6 = false;
				this.getExeats().then(() => (this.isLoading = false));
			} catch (error) {
				throw error;
			}
		},
		clear() {
			this.departureTime = null;
			this.departureDate = null;
			this.selectedExeatType = null;
			this.reason = "";
			this.files = [];
			this.dialog3 = false;
		},

		close() {
			this.dialog = false;
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},

		save() {
			if (this.editedIndex > -1) {
				Object.assign(this.desserts[this.editedIndex], this.editedItem);
			} else {
				this.desserts.push(this.editedItem);
			}
			this.close();
		},
		async getExeatTypes() {
			try {
				let res = await Axios.get("exeat-type");
				console.table(res.data);
				this.exeatTypes = res.data.data;
			} catch (error) {
				throw error;
			}
		},
		async getExeats() {
			try {
				let res = await Axios.get("exeat");

				this.exeats = res.data.data;
				console.table(res.data);
			} catch (error) {
				throw error;
			}
		}
	}
};
</script>