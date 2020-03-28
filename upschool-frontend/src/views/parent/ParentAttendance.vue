<template>
	<v-app>
		<div>
			<div class="my-5">Events & Attendance</div>
			<div>
				<div class="d-flex mb-4">
					<metric title="Number of Events" :value="events.length" />
				</div>

				<div>
					<v-row>
						<v-col cols="12" md="9">
							<v-card flat class="pa-3">
								<div class="d-flex justify-space-between align-center">
									<v-subheader class="pa-0">EVENTS</v-subheader>
									<div>
										<v-dialog v-model="dialog" persistent max-width="600px">
											<template v-slot:activator="{ on }">
												<v-btn color="primary" dark depressed v-on="on">ADD EVENT</v-btn>
											</template>
											<v-card>
												<v-card-title>
													<span class="headline">Create Event</span>
												</v-card-title>
												<v-card-text>
													<v-container>
														<v-row>
															<v-col cols="12" sm="6" md="12">
																<v-text-field label="Title of Event" outlined required></v-text-field>
															</v-col>
															<v-col cols="12" sm="6" md="12">
																<v-combobox
																	v-model="selectFrequency"
																	:items="frequency"
																	tile
																	label="Frequency"
																	multiple
																	chips
																	required
																></v-combobox>
															</v-col>
															<v-col cols="12" sm="6" md="12">
																<VueTrix
																	v-model="editorContent"
																	placeholder="Describe the event"
																	localStorage
																	style="width: 100%"
																/>
															</v-col>
															<v-col cols="12" sm="6" md="12">
																<v-select
																	:items="priority"
																	label="Priority"
																	hint="Voluntary or Mandatory"
																	persistent-hint
																	required
																	tile
																	outlined
																></v-select>
															</v-col>
															<v-col cols="12" sm="6" md="12">
																<v-combobox
																	v-model="selectAttendableApply"
																	:items="attendableGroups"
																	tile
																	label="Apply To"
																	multiple
																	chips
																	required
																></v-combobox>
															</v-col>
															<!-- <v-col cols="12">
																<v-text-field label="Email*" required></v-text-field>
															</v-col>
															<v-col cols="12">
																<v-text-field label="Password*" type="password" required></v-text-field>
															</v-col>
															<v-col cols="12" sm="6">
																<v-select :items="['0-17', '18-29', '30-54', '54+']" label="Age*" required></v-select>
															</v-col>
															<v-col cols="12" sm="6">
																<v-autocomplete
																	:items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
																	label="Interests"
																	multiple
																></v-autocomplete>
															</v-col>-->
														</v-row>
													</v-container>
													<small>*indicates required field</small>
												</v-card-text>
												<v-card-actions>
													<v-spacer></v-spacer>
													<v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
													<v-btn color="blue darken-1" text @click="dialog = false">Save</v-btn>
													<v-btn
														class="white--text"
														color="primary"
														depressed
														@click="dialog = false"
													>Activate & Save</v-btn>
												</v-card-actions>
											</v-card>
										</v-dialog>
									</div>
								</div>

								<div class="fs-5 font-italic">
									<v-icon size="10" class="mr-1" color="blue">mdi-information</v-icon>Click table item to view
								</div>

								<v-data-table
									:headers="headers"
									:items="events"
									:search="search"
									sort-by="calories"
									@click:row="goToPage"
									:items-per-page="5"
								>
									<template v-slot:item.fat="{ item }">
										<v-chip :color="getColor(item.fat)" dark>{{ item.fat }}</v-chip>
									</template>
									<template v-slot:item.carbs="{ item }">
										<div class="pr-4">
											<v-icon
												size="15"
												:color="item.carbs == 'Voluntary' ? 'info lighten-3': 'red lighten-3'"
											>mdi-circle-slice-8</v-icon>
										</div>
									</template>
								</v-data-table>
							</v-card>
						</v-col>
						<v-col cols="12" md="3">
							<v-card flat class="pa-3">
								<v-subheader class="pa-0">ATTENDABLE GROUPS</v-subheader>

								<div class="d-flex fs-4 mb-3" v-for="(attendableGroup, idx) in attendableGroups" :key="idx">
									<div class="pr-4">
										<v-icon size="15">mdi-circle-slice-8</v-icon>
									</div>
									<div>{{attendableGroup}}</div>
								</div>

								<div class="mt-4">
									<v-dialog
										v-model="dialogFull"
										fullscreen
										hide-overlay
										transition="dialog-bottom-transition"
									>
										<template v-slot:activator="{ on }">
											<v-btn color="success" depressed dark v-on="on">Create Attendable Group</v-btn>
										</template>
										<v-card>
											<v-toolbar dark color="primary">
												<v-btn icon dark @click="dialogFull = false">
													<v-icon>mdi-close</v-icon>
												</v-btn>
												<v-toolbar-title>Manage Attendable Group</v-toolbar-title>
												<v-spacer></v-spacer>
												<v-toolbar-items>
													<v-btn dark text @click="dialogFull = false">Save</v-btn>
												</v-toolbar-items>
											</v-toolbar>
											<v-list three-line subheader>
												<!-- <v-subheader>ATTENDABLE GROUPS</v-subheader> -->
												<!-- <v-list-item>
													<v-list-item-content>
														<v-list-item-title>ATTENDABLE GROUPS</v-list-item-title>
														<v-row>
															<v-col cols="12" md="12">
																<div
																	class="d-flex align-center fs-4 mb-3 mt-2 justify-space-between"
																	v-for="(attendableGroup, idx) in attendableGroups"
																	:key="idx"
																>
																	<div class="d-flex align-center">
																		<div class="pr-4">
																			<v-icon size="15">mdi-circle-slice-8</v-icon>
																		</div>
																		<div>{{ attendableGroup}}</div>
																	</div>
																</div>
															</v-col>
														</v-row>
													</v-list-item-content>
												</v-list-item>-->
												<v-list-item>
													<v-list-item-content>
														<v-list-item-title>Manage Attendable Group</v-list-item-title>
														<div>
															<v-data-table
																v-model="selected"
																:headers="studentHeaders"
																:items="students"
																:single-select="singleSelect"
																item-key="name"
																show-select
																class="elevation-1"
															>
																<template v-slot:top>
																	<div class="d-flex justify-space-between align-center">
																		<div>
																			<v-select
																				v-model="selectAttendableGroup"
																				:items="attendableGroups"
																				outlined
																				clearable
																				label="Select Group to Edit"
																				class="pa-3"
																			/>
																		</div>
																		<v-spacer></v-spacer>
																		<div class="d-flex mb-3">
																			<v-btn color="success" text v-if="selectAttendableGroup ">IMPORT CSV</v-btn>
																			<v-btn color="success" text v-if="selectAttendableGroup ">EXPORT CSV</v-btn>
																			<v-btn color="primary" depressed>Save Selected</v-btn>
																			<v-btn
																				color="primary"
																				text
																				depressed
																				v-if="!selectAttendableGroup"
																				:disabled="!selectAttendableGroup && selected.length < 1"
																			>New Group</v-btn>
																		</div>
																	</div>
																</template>
																<template v-slot:item.actions="{ item }">
																	<v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
																</template>
															</v-data-table>
														</div>
													</v-list-item-content>
												</v-list-item>
											</v-list>
											<v-divider></v-divider>
											<!-- <v-list three-line subheader>
												<v-subheader>General</v-subheader>
												<v-list-item>
													<v-list-item-action>
														<v-checkbox v-model="notifications"></v-checkbox>
													</v-list-item-action>
													<v-list-item-content>
														<v-list-item-title>Notifications</v-list-item-title>
														<v-list-item-subtitle>Notify me about updates to apps or games that I downloaded</v-list-item-subtitle>
													</v-list-item-content>
												</v-list-item>
												<v-list-item>
													<v-list-item-action>
														<v-checkbox v-model="sound"></v-checkbox>
													</v-list-item-action>
													<v-list-item-content>
														<v-list-item-title>Sound</v-list-item-title>
														<v-list-item-subtitle>Auto-update apps at any time. Data charges may apply</v-list-item-subtitle>
													</v-list-item-content>
												</v-list-item>
												<v-list-item>
													<v-list-item-action>
														<v-checkbox v-model="widgets"></v-checkbox>
													</v-list-item-action>
													<v-list-item-content>
														<v-list-item-title>Auto-add widgets</v-list-item-title>
														<v-list-item-subtitle>Automatically add home screen widgets</v-list-item-subtitle>
													</v-list-item-content>
												</v-list-item>
											</v-list>-->
										</v-card>
									</v-dialog>
								</div>
							</v-card>

							<v-card flat class="pa-3 mt-4">
								<v-subheader class="pa-0">PRIORITY LEVELS</v-subheader>

								<div class="d-flex fs-4 mb-3">
									<div class="pr-4">
										<v-icon size="15" color="info lighten-3">mdi-circle-slice-8</v-icon>
									</div>
									<div>Voluntary</div>
								</div>
								<div class="d-flex fs-4 mb-3">
									<div class="pr-4">
										<v-icon size="15" color="red lighten-3">mdi-alert-circle</v-icon>
									</div>
									<div>Mandatory</div>
								</div>
							</v-card>
						</v-col>
					</v-row>

					<!-- <div>dkdk</div> -->
				</div>
			</div>
		</div>
	</v-app>
</template>

<script>
import Metric from "./../../components/parent/Metric";
import VueTrix from "vue-trix";

// import VueApexCharts from "vue-apexcharts";

export default {
	components: {
		Metric,
		VueTrix
		// apexchart: VueApexCharts
	},
	// name: "attendance",
	data: () => ({
		search: "",
		dialog: false,
		dialogFull: false,
		selectFrequency: null,
		selectAttendableGroup: null,
		selectAttendableApply: null,
		notifications: false,
		sound: true,
		editorContent: null,
		widgets: false,
		singleSelect: false,
		selected: [],
		attendableGroups: [
			"All 100 level Students",
			"All 300 level students",
			"All CST Students",
			"All SIWES Students",
			"All Final year students"
		],
		frequency: [
			"Once",
			"Mondays",
			"Tuesdays",
			"Wednesdays",
			"Thursdays",
			"Fridays",
			"Saturdays",
			"Sundays"
		],
		priority: ["Voluntary", "Mandatory"]
	}),
	computed: {
		students() {
			return this.$store.state.students;
		},
		studentHeaders() {
			return this.$store.state.studentHeaders;
		},
		events() {
			return this.$store.state.events;
		},
		headers() {
			return this.$store.state.eventHeaders;
		}
	},
	methods: {
		goToPage(v) {
			// console.log(v);
			this.$router.push({
				name: "parent.attendance.details",
				params: { id: v.id }
			});
		},
		getColor(calories) {
			if (calories == "Active") return "green accent-3";
			else if (calories == "Inactive") return "red accent-2";
			else return "green";
		},
		editItem() {},
		deleteItem() {}
	}
};
</script>