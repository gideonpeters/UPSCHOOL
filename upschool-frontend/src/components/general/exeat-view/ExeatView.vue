<template>
	<v-card flat min-height="800px">
		<v-container>
			<div class="d-flex justify-space-between align-center">
				<div class="d-flex align-center">
					<v-btn icon color="grey" @click="$router.go(-1)">
						<v-icon>mdi-arrow-left</v-icon>
					</v-btn>
					<div class>Exeat Applications</div>
				</div>
				<v-dialog v-model="dialog3" persistent max-width="600px">
					<template v-slot:activator="{ on }">
						<v-btn color="primary" small dark depressed v-on="on">APPLY FOR EXEAT</v-btn>
					</template>
					<v-card>
						<v-card-title>
							<span class="headline">APPLY FOR EXEAT</span>
						</v-card-title>
						<v-card-text>
							<v-container>
								<v-row>
									<v-col cols="12">
										<v-select v-model="selectedExeatType" outlined label="Select Type*" :items="exeatTypes"></v-select>
									</v-col>
									<v-col cols="12">
										<v-textarea v-model="reason" outlined rows="10" label="Reason"></v-textarea>
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
			</div>
			<v-row>
				<v-col cols="4" v-if="isAdmin">
					<v-card class="elevation-1 px-3 pa-3 pb-5">
						<div class="d-flex flex-column align-center pb-5">
							<div class="my-3">
								<v-avatar height="130" width="130">
									<v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
								</v-avatar>
							</div>
							<div>PETERS GIDEON OJOAJOGU</div>
							<div class="py-3">15CJ02876</div>
							<div class="pb-3">B.Eng. COMPUTER ENGINEERING/EIE</div>
							<div class="pb-5">Daniel Hall/C302</div>
						</div>
					</v-card>
				</v-col>

				<v-col>
					<v-expansion-panels multiple>
						<v-expansion-panel v-for="(item, i) in 5" :key="i">
							<v-expansion-panel-header>
								<div class="font-weight-bold fs-3">
									<v-icon
										size="18"
										class="mr-2"
										:color="
										i == 1
											? 'blue accent-2'
											: 'orange accent-2'
									"
									>mdi-circle-slice-8</v-icon>EXT2309202015CJ02876
								</div>
							</v-expansion-panel-header>
							<v-expansion-panel-content>
								<div>
									<div class="font-weight-bold fs-4">EXEAT TYPE</div>
									<div>HOME EXEAT</div>
								</div>

								<div class="my-4">
									<div class="font-weight-bold fs-4">DURATION</div>
									<div>3 days</div>
								</div>

								<div class="mb-4 d-flex align-center">
									<div class="font-weight-bold fs-4 mr-5">STATUS:</div>
									<v-chip color="yellow darken-2" small class="white--text">Pending</v-chip>
								</div>

								<div class="mb-4">
									<div class="font-weight-bold fs-4">REASON</div>
									<div>
										Lorem ipsum dolor sit amet, consectetur
										adipiscing elit, sed do eiusmod tempor
										incididunt ut labore et dolore magna aliqua.
										Ut enim ad minim veniam, quis nostrud
										exercitation ullamco laboris nisi ut aliquip
										ex ea commodo consequat.
									</div>
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
									<div>8:00 AM 22nd March, 2020</div>
								</div>

								<div class="mb-4">
									<div class="font-weight-bold fs-4">DATE/TIME OF DEPARTURE</div>
									<div>8:00 AM 22nd March, 2020</div>
								</div>

								<div class="mb-4">
									<div class="font-weight-bold fs-4">DATE/TIME OF ARRIVAL</div>
									<div>8:00 AM 25th March, 2020</div>
								</div>

								<div class="mb-4">
									<div class="font-weight-bold fs-4">PROGRESS</div>
									<div>
										<v-progress-linear value="15"></v-progress-linear>
									</div>
								</div>

								<div class="mb-4">
									<div class="font-weight-bold fs-4">ATTACHMENTS</div>
									<div>8:00 AM 25th March, 2020</div>
								</div>

								<div class="d-flex justify-end">
									<v-dialog v-model="dialog2" persistent max-width="290">
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
															<textarea outlined label="Outlined textarea" placeholder="Type here" name="remarks"></textarea>
														</v-col>
													</v-row>
												</div>
											</v-card-text>
											<v-card-actions>
												<v-spacer></v-spacer>
												<v-btn color="green darken-1" text @click="dialog2 = false">Disagree</v-btn>
												<v-btn color="green darken-1" text @click="dialog2 = false">Agree</v-btn>
											</v-card-actions>
										</v-card>
									</v-dialog>
									<v-dialog v-model="dialog" persistent max-width="290">
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
															<textarea outlined label="Outlined textarea" placeholder="Type here" name="remarks"></textarea>
														</v-col>
													</v-row>
												</div>
											</v-card-text>
											<v-card-actions>
												<v-spacer></v-spacer>
												<v-btn color="green darken-1" text @click="dialog = false">Disagree</v-btn>
												<v-btn color="green darken-1" text @click="dialog = false">Agree</v-btn>
											</v-card-actions>
										</v-card>
									</v-dialog>
								</div>
							</v-expansion-panel-content>
						</v-expansion-panel>
					</v-expansion-panels>
				</v-col>
			</v-row>
		</v-container>
	</v-card>
</template>

<script>
import Axios from "axios";
export default {
	props: {
		isAdmin: {
			type: Boolean,
			default: false
		},
		isStudent: {
			type: Boolean,
			default: false
		},
		isStaff: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			dialog: false,
			dialog2: false,
			dialog3: false,
			menuDepartureTime: null,
			departureTime: null,
			modalDepartureDate: null,
			departureDate: null,
			rules: [
				value =>
					!value ||
					value.size < 2000000 ||
					"Cover image size should be less than 2 MB!"
			],
			exeatTypes: [],
			files: [],
			reason: "",
			selectedExeatType: ""
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
		async getExeats() {
			try {
				let id = this.$route.params.id;
				let res = await Axios.get(`exeat?student_id=${id}`);
				console.table(res.data);
				this.exeatTypes = res.data.data;
			} catch (error) {
				throw error;
			}
		},
		async submitExeat() {
			try {
				let res = await Axios.post("exeat");
				console.table(res.data);
				this.exeatTypes = res.data.data;
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
		}
	},
	mounted() {
		this.getExeats();
	}
};
</script>
