<template>
	<v-app>
		<v-card flat min-height="800px">
			<v-container>
				<v-row>
					<v-col cols="12">
						<v-card class="pa-3">
							<div class="d-flex align-center">
								<v-subheader>EXEAT TYPES</v-subheader>
								<v-spacer></v-spacer>
								<v-dialog v-model="dialog3" persistent max-width="600px">
									<template v-slot:activator="{ on }">
										<v-btn color="primary" small dark depressed v-on="on">CREATE EXEAT TYPE</v-btn>
									</template>
									<v-card>
										<v-card-title>
											<span class="headline">Create Exeat Type</span>
										</v-card-title>
										<v-card-text>
											<v-container>
												<v-row>
													<v-col cols="12">
														<v-text-field v-model="name" outlined label="Name of exeat type*"></v-text-field>
													</v-col>
													<v-col cols="12">
														<v-textarea v-model="description" outlined rows="10" label="Description"></v-textarea>
													</v-col>
													<v-col cols="12">
														<v-select
															v-model="metric"
															outlined
															label="Select Metric*"
															:items="['hours','days', 'weeks', 'months']"
														></v-select>
													</v-col>
													<v-col cols="12">
														<v-text-field
															v-model="duration"
															type="number"
															outlined
															label="Duration of exeat type*"
														></v-text-field>
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
											<v-btn color="error darken-1" outlined text @click="close">Cancel</v-btn>
											<v-btn color="success darken-1" depressed @click="createExeatType">Submit</v-btn>
										</v-card-actions>
									</v-card>
								</v-dialog>
							</div>
							<v-data-table :headers="exeatHeaders" :items="exeatTypes"></v-data-table>
						</v-card>
					</v-col>
					<v-col cols="12">
						<v-card class="pa-3">
							<div class="d-flex align-center">
								<v-subheader>LEAVE TYPES</v-subheader>
								<v-spacer></v-spacer>
								<v-dialog v-model="dialog4" persistent max-width="600px">
									<template v-slot:activator="{ on }">
										<v-btn color="primary" small dark depressed v-on="on">CREATE LEAVE TYPE</v-btn>
									</template>
									<v-card>
										<v-card-title>
											<span class="headline">Create Leave Type</span>
										</v-card-title>
										<v-card-text>
											<v-container>
												<v-row>
													<v-col cols="12">
														<v-text-field v-model="name" outlined label="Name of leave type*"></v-text-field>
													</v-col>
													<v-col cols="12">
														<v-textarea v-model="description" outlined rows="10" label="Description"></v-textarea>
													</v-col>
													<v-col cols="12">
														<v-select
															v-model="metric"
															outlined
															label="Select Metric*"
															:items="['hours','days', 'weeks', 'months']"
														></v-select>
													</v-col>
													<v-col cols="12">
														<v-text-field
															v-model="duration"
															type="number"
															outlined
															label="Duration of leave type*"
														></v-text-field>
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
											<v-btn color="error darken-1" outlined text @click="dialog4 = false">Cancel</v-btn>
											<v-btn color="success darken-1" depressed @click="dialog4 = false">Submit</v-btn>
										</v-card-actions>
									</v-card>
								</v-dialog>
							</div>
							<v-data-table :headers="leaveHeaders" :items="leaveTypes"></v-data-table>
						</v-card>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
	</v-app>
</template>

<script>
import Axios from "axios";
export default {
	props: {
		isStudent: { type: Boolean, default: false },
		isStaff: { type: Boolean, default: false },
		isAdmin: { type: Boolean, default: false }
	},
	data() {
		return {
			exeatHeaders: [
				{ text: "Name", value: "name" },
				{ text: "Metric", value: "metric" },
				{ text: "Duration", value: "duration" },
				{ text: "Description", value: "description" },
				{ text: "Actions", value: "actions" }
			],
			leaveHeaders: [
				{ text: "Name", value: "name" },
				{ text: "Metric", value: "metric" },
				{ text: "Duration", value: "duration" },
				{ text: "Description", value: "description" },
				{ text: "Actions", value: "actions" }
			],
			dialog4: null,
			dialog3: null,
			name: "",
			description: "",
			metric: "",
			duration: "",
			exeatTypes: [],
			leaveTypes: []
		};
	},
	methods: {
		async getExeatTypes() {
			try {
				let res = await Axios.get("exeat-type");
				console.table(res.data);
				this.exeatTypes = res.data.data;
			} catch (error) {
				throw error;
			}
		},
		async getLeaveTypes() {
			try {
				let res = await Axios.get("leave-type");

				this.leaveTypes = res.data.data;
			} catch (error) {
				throw error;
			}
		},
		close() {
			this.dialog4 = false;
			this.dialog3 = false;
			this.name = "";
			this.description = "";
			this.metric = "";
			this.duration = "";
		},
		async createExeatType() {
			try {
				let body = {
					name: this.name,
					description: this.description,
					metric: this.metric.toLowerCase(),
					duration: this.duration
				};

				let res = await Axios.post("exeat-type", body);
				this.close();
				this.$store.commit("openSnackbar", res.data.message);
				console.table(res.data);
				if (res.data.status) {
					this.getExeatTypes();
				}
			} catch (error) {
				throw error;
			}
		}
	},
	mounted() {
		this.getExeatTypes();
	},
	watch: {
		duration(v) {
			if (v < 1) {
				this.duration = 1;
			}
		}
	}
};
</script>