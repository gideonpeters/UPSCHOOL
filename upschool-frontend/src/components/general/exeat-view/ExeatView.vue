<template>
	<div>
		<v-container>
			<div class="d-flex justify-space-between align-center">
				<div class="d-flex align-center">
					<v-btn icon color="grey" @click="$router.go(-1)">
						<v-icon>mdi-arrow-left</v-icon>
					</v-btn>
					<div class>Exeat Applications</div>
				</div>
				<div>
					<v-btn @ color="blue accent-2 white--text" depressed>Apply for Exeat</v-btn>
				</div>
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
								<div class="mb-4 d-flex justify-space-between">
									<div>
										<div class="font-weight-bold fs-4">EXEAT TYPE</div>
										<div>HOME EXEAT</div>
									</div>
									<div>
										<v-icon color="grey">mdi-flag</v-icon>
									</div>
								</div>

								<div class="mb-4">
									<div class="font-weight-bold fs-4">DURATION</div>
									<div>3 days</div>
								</div>

								<div class="mb-4">
									<div class="font-weight-bold fs-4">STATUS</div>
									<v-chip color="orange accent-2 mt-2">Pending</v-chip>
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
	</div>
</template>

<script>
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
			dialog2: false
		};
	}
};
</script>
