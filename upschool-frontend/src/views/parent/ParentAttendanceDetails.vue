<template>
	<v-app>
		<v-container>
			<v-row>
				<v-col cols="12">
					<div class="my-5 align-center d-flex">
						<v-btn icon color="grey" @click="$router.go(-1)">
							<v-icon small>mdi-arrow-left</v-icon>
						</v-btn>
						<v-skeleton-loader
							v-if="isLoading"
							ref="skeleton"
							:boilerplate="boilerplate"
							type="list-item"
							:tile="tile"
							width="60%"
							class
						></v-skeleton-loader>
						<div v-if="!isLoading">
							<span>Events & Attendance/</span>
							<span>{{ event.name }}</span>
						</div>
					</div>
				</v-col>
				<v-col cols="12" sm="6" md="4">
					<v-text-field
						v-model="search"
						single-line
						hide-details
						flat
						label="Search participants by name, matric number, staff number"
						solo
						prepend-inner-icon="mdi-magnify"
					></v-text-field>
				</v-col>
				<v-col>
					<v-autocomplete
						solo
						flat
						dense
						return-object
						cache-items
						v-model="date"
						:items="dates"
						item-text="formatted"
						filled
						label="Select Date to view"
					></v-autocomplete>
				</v-col>
				<v-col>
					<div class="d-flex">
						<v-spacer></v-spacer>
						<div class="d-flex align-center justify-end">
							<div v-if="!isLoading">
								<v-menu offset-y>
									<template v-slot:activator="{ on }">
										<v-btn v-on="on" color icon>
											<v-icon color="grey" small>mdi-dots-vertical</v-icon>
										</v-btn>
									</template>
									<v-list>
										<v-list-item>
											<v-list-item-title>
												View
												defaulters
											</v-list-item-title>
										</v-list-item>
										<v-list-item>
											<v-list-item-title>
												Export Data as
												CSV
											</v-list-item-title>
										</v-list-item>
										<v-list-item @click="dialogFull = true">
											<v-list-item-title>
												Import Attendance
												Data
											</v-list-item-title>
										</v-list-item>
										<v-list-item @click="isAnalysis = true">
											<v-list-item-title>
												View
												{{isAnalysis?'General' :'Analysis'}}
											</v-list-item-title>
										</v-list-item>
										<v-list-item @click="isStudent = !isStudent">
											<v-list-item-title>
												View
												{{!isStudent ? 'Student': 'Staff'}}
											</v-list-item-title>
										</v-list-item>
									</v-list>
								</v-menu>
							</div>
						</div>
					</div>
					<div class>
						<v-dialog v-model="dialogFull" fullscreen hide-overlay transition="dialog-bottom-transition">
							<v-card>
								<v-toolbar dark color="primary">
									<v-btn icon dark @click="dialogFull = false">
										<v-icon>mdi-close</v-icon>
									</v-btn>
									<v-toolbar-title>IMPORT ATTENDANCE</v-toolbar-title>
									<v-spacer></v-spacer>
									<v-toolbar-items>
										<v-btn
											dark
											text
											:disabled="
												!dummy || dummy.length < 0
											"
											@click="saveBulk"
										>Save</v-btn>
									</v-toolbar-items>
								</v-toolbar>

								<v-list three-line subheader>
									<v-list-item>
										<v-list-item-content>
											<v-container>
												<v-list-item-title>Import Attendance</v-list-item-title>
												<v-row>
													<v-col cols="12">
														<v-checkbox
															v-model="isStudentUpload"
															:label="`Uploading for ${ isStudentUpload ? 'Students': 'Staff'}`"
														></v-checkbox>
													</v-col>
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
															hint="make sure to download template before uploading file and upload with headers from template still present and unchanged in position (ids not inserted from users assigned to this event are automatically left pending)"
															prepend-icon
															prepend-inner-icon="mdi-paperclip"
															outlined
															v-model="file"
															accept=".csv"
															@change="showCsv"
															label="Select csv file"
														></v-file-input>
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
						<div class="d-flex align-center">
							<v-subheader>ATTENDANCE OVERVIEW ({{ isStudent ? 'Students' : 'Staff' }})</v-subheader>
							<v-spacer></v-spacer>
							<v-switch v-model="isSelecting" label="Edit Multiple"></v-switch>
							<v-menu offset-y v-if="isSelecting">
								<template v-slot:activator="{ on }">
									<v-btn :disabled="selectedItems.length == 0" class="ml-3" small v-on="on" depressed>ACTIONS</v-btn>
								</template>
								<v-list>
									<v-list-item @click="respondToAttendance(true,1, true)">
										<v-list-item-title>Mark as Present</v-list-item-title>
									</v-list-item>
									<v-list-item @click="respondToAttendance(false,1, true)">
										<v-list-item-title>Mark as Absent</v-list-item-title>
									</v-list-item>
								</v-list>
							</v-menu>
						</div>
						<div>
							<v-data-table
								v-model="selectedItems"
								:loading="isLoading"
								:headers="headers"
								:items="participants"
								:search="search"
								:show-select="isSelecting"
								:items-per-page="5"
							>
								<template v-slot:item.action="{ item }">
									<v-btn icon color="grey" @click="goToPage(item)">
										<v-icon small>mdi-eye</v-icon>
									</v-btn>
									<v-menu offset-y :close-on-content-click="true">
										<template v-slot:activator="{ on }">
											<v-btn v-on="on" color="grey" icon>
												<v-icon small>mdi-pencil</v-icon>
											</v-btn>
										</template>
										<v-list>
											<v-list-item @click="respondToAttendance(true, item)">
												<v-list-item-title>
													Mark as
													Present
												</v-list-item-title>
											</v-list-item>
											<v-list-item @click="respondToAttendance(false, item)">
												<v-list-item-title>
													Mark as
													Absent
												</v-list-item-title>
											</v-list-item>
										</v-list>
									</v-menu>
								</template>
								<template v-slot:item.percentage="{ item }">
									{{
									(
									(item.weighted_attendance /
									event.total_attendance) *
									100
									).toFixed(2)
									}}
								</template>
								<template v-slot:item.presence="{ item }">
									<v-chip small class="text-uppercase" :color="getStatus(item.presence)">{{item.presence}}</v-chip>
								</template>
							</v-data-table>
						</div>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import Axios from "axios";
import Papa from "papaparse";
import { saveAs } from "file-saver";

export default {
	data() {
		return {
			search: "",
			isSelecting: false,
			isStudent: true,
			isAnalysis: false,
			dialogFull: false,
			selectedItems: [],
			tile: false,
			boilerplate: false,
			isLoading: true,
			date: null,
			isStudentUpload: true,
			dates: [],
			file: [],
			participants: [],
			bulkHeaders: [],
			dummy: [],
			menu: false,
			modal: false,
			menu2: false,
			headers: [
				{
					text: "NAME",
					align: "start",
					sortable: false,
					value: "user.name"
				},
				{
					text: "MATRICULATION NUMBER",
					value: "user.userable.matric_number"
				},
				{ text: "PROGRAM", value: "user.userable.program.name" },
				{ text: "LEVEL", value: "user.userable.level" },
				// { text: "RESIDENCE", value: "residence" },
				{ text: "STATUS", value: "presence" },
				{ text: "ACTIONS", value: "action", align: "center" }
			],
			event: {}
		};
	},
	async mounted() {
		try {
			this.getEvent().then(() => (this.isLoading = false));
		} catch (error) {
			throw error;
		}
	},
	computed: {
		csvData() {
			let ans;
			if (this.isStudentUpload) {
				ans = [
					{
						matric_number: ""
					}
				];
			} else {
				ans = [{ staff_number: "" }];
			}
			return ans;
		}
	},
	methods: {
		saveBulk() {},
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
		async downloadFormat() {
			var csv = await Papa.unparse(this.csvData);

			var csvData = new File(
				[csv],
				`attendance_template_${this.event.name}_${this.date.raw}.csv`,
				{
					type: "text/csv;charset=utf-8"
				}
			);

			saveAs(csvData);
		},
		getStatus(val) {
			let res;
			switch (val) {
				case "pending":
					res = "yellow accent-4";
					break;
				case "present":
					res = "green accent-2";
					break;
				case "absent":
					res = "red accent-2";
					break;

				default:
					res = "yellow accent-2";
					break;
			}
			return res;
		},
		goToPage(v) {
			this.$router.push({
				name: "parent.attendance-view",
				params: {
					id: this.isStudent
						? v.user.userable.matric_number
						: v.user.userable.staff_number
				}
			});
		},
		async respondToAttendance(val = false, item, multiple = false) {
			try {
				let id = this.$route.params.id;
				let ids = this.selectedItems.map(item => item.id);
				await Axios.post(
					`attendance/${id}?action=${val}&multiple=${multiple}`,
					{
						status: val,
						ids: JSON.stringify(ids)
					}
				).then(value => {
					console.log(value.data);
					if (!multiple) {
						item.presence = val ? "present" : "absent";
					} else {
						this.getEventParticipants();
					}
					this.$store.commit("openSnackbar", value.data.message);
				});

				// this.getExeats().then(() => (this.isLoading = false));
			} catch (error) {
				throw error;
			}
		},
		async getEvent() {
			try {
				let id = this.$route.params.id;
				let res = await Axios.get(`event/${id}?date=${this.date}`);
				if (res.data.status) {
					this.event = res.data.data;
					this.dates = this.event.dates.map(item => {
						return {
							formatted: this.moment(item).format(
								"dddd, MMMM Do YYYY, [at] h:mm a"
							),
							raw: item
						};
					});
					if (!this.date) {
						this.date = this.dates[0];
						this.getEventParticipants();
					}
				}
				console.log(res.data);
			} catch (error) {
				throw error;
			}
		},
		async getEventParticipants() {
			try {
				this.isLoading = true;
				let id = this.$route.params.id;
				let date = this.date ? this.date.raw : null;
				await Axios.get(
					`attendance/${id}/?date=${date}&type=${
						this.isStudent ? "student" : "staff"
					}`
				).then(res => {
					console.log(res.data);
					this.participants = res.data.data;
					this.isLoading = false;
				});
			} catch (error) {
				throw error;
			}
		},
		editItem() {},
		deleteItem() {}
	},
	watch: {
		isSelecting(v) {
			if (!v) {
				this.headers.push({
					text: "ACTIONS",
					value: "action",
					align: "center"
				});
			} else {
				this.headers.pop();
			}
		},
		date() {
			this.getEventParticipants();
		},
		isStudent() {
			this.getEventParticipants();
		}
	}
};
</script>
