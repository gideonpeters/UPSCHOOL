<template>
	<v-app>
		<div class="my-5">
			<v-btn color="grey" small text @click="$router.go(-1)">
				<v-icon class="mr-1" size="15">mdi-arrow-left</v-icon>Go
				back
			</v-btn>
		</div>
		<v-stepper v-model="e1" depressed>
			<v-stepper-header>
				<v-stepper-step :complete="e1 > 1" step="1">
					Academic Session
					<small>Academic Year and Semester</small>
				</v-stepper-step>

				<v-divider></v-divider>

				<v-stepper-step :complete="e1 > 2" step="2">Name of step 2</v-stepper-step>

				<v-divider></v-divider>

				<v-stepper-step step="3">Name of step 3</v-stepper-step>
			</v-stepper-header>

			<v-stepper-items>
				<v-stepper-content step="1">
					<v-card flat class="mb-12" min-height="500px">
						<v-subheader>ACADEMIC YEAR</v-subheader>
						<v-row>
							<v-col cols="6" md="6">
								<v-select
									bottom
									v-model="academicYearName"
									:items="[
										'Create New Academic Year',
										...academicYears
									]"
									label="Select Academic Year (e.g. 2019/2020 Academic Session)"
									outlined
								></v-select>
							</v-col>
							<v-col v-if="isNew">
								<v-text-field v-model="newAcademicYearName" label="Name of Academic Year" outlined></v-text-field>
							</v-col>
							<v-col cols="12" sm="6" md="6">
								<v-menu
									v-model="menu2"
									:close-on-content-click="false"
									:nudge-right="40"
									transition="scale-transition"
									offset-y
									min-width="290px"
								>
									<template v-slot:activator="{ on }">
										<v-text-field
											v-model="startDate"
											label="Start Date"
											prepend-inner-icon="mdi-calendar"
											readonly
											outlined
											v-on="on"
										></v-text-field>
									</template>
									<v-date-picker v-model="startDate" @input="menu2 = false"></v-date-picker>
								</v-menu>
							</v-col>
							<v-col cols="12" sm="6" md="6">
								<v-menu
									v-model="menu3"
									:close-on-content-click="false"
									:nudge-right="40"
									transition="scale-transition"
									offset-y
									min-width="290px"
								>
									<template v-slot:activator="{ on }">
										<v-text-field
											v-model="endDate"
											label="End Date"
											prepend-inner-icon="mdi-calendar"
											readonly
											outlined
											v-on="on"
										></v-text-field>
									</template>
									<v-date-picker v-model="endDate" @input="menu3 = false"></v-date-picker>
								</v-menu>
							</v-col>
							<!-- <v-col cols="12">
								<div class="d-flex">
									<v-spacer></v-spacer>
									<v-btn color="success" depressed small v-if="isYearComplete"
										>Save</v-btn
									>
								</div>
							</v-col>-->
						</v-row>

						<v-subheader>SEMESTER</v-subheader>
						<v-row>
							<v-col cols="6" md="6">
								<v-select
									bottom
									v-model="semesterName"
									:items="[
										'Create New Semester Type',
										...semesterTypes
									]"
									label="Select Semester (e.g. Fall Semester or Spring Semester)"
									outlined
								></v-select>
							</v-col>
							<v-col v-if="isNewSemester">
								<v-text-field v-model="newSemesterName" label="Name of Semester" outlined></v-text-field>
							</v-col>
							<v-col cols="12" sm="6" md="6">
								<v-menu
									v-model="menu4"
									:close-on-content-click="false"
									:nudge-right="40"
									transition="scale-transition"
									offset-y
									min-width="290px"
								>
									<template v-slot:activator="{ on }">
										<v-text-field
											v-model="semesterStartDate"
											label="Start Date"
											prepend-inner-icon="mdi-calendar"
											readonly
											outlined
											v-on="on"
										></v-text-field>
									</template>
									<v-date-picker v-model="semesterStartDate" @input="menu4 = false"></v-date-picker>
								</v-menu>
							</v-col>
							<v-col cols="12" sm="6" md="6">
								<v-menu
									v-model="menu5"
									:close-on-content-click="false"
									:nudge-right="40"
									transition="scale-transition"
									offset-y
									min-width="290px"
								>
									<template v-slot:activator="{ on }">
										<v-text-field
											v-model="semesterEndDate"
											label="End Date"
											prepend-inner-icon="mdi-calendar"
											readonly
											outlined
											v-on="on"
										></v-text-field>
									</template>
									<v-date-picker v-model="semesterEndDate" @input="menu5 = false"></v-date-picker>
								</v-menu>
							</v-col>
							<!-- <v-col cols="12">
								<div class="d-flex">
									<v-spacer></v-spacer>
									<v-btn color="success" depressed small
										>CONTINUE</v-btn
									>
								</div>
							</v-col>-->
						</v-row>
					</v-card>

					<v-btn color="success" depressed @click="submitAcademicYear">Save & Activate</v-btn>

					<v-btn text @click="$router.go(-1)">Cancel</v-btn>
				</v-stepper-content>

				<v-stepper-content step="2">
					<v-card flat class="mb-12" min-height="500px"></v-card>

					<v-btn color="primary" @click="e1 = 3">Continue</v-btn>

					<v-btn text>Cancel</v-btn>
				</v-stepper-content>

				<v-stepper-content step="3">
					<v-card class="mb-12" color="grey lighten-1" height="200px"></v-card>

					<v-btn color="primary" @click="e1 = 1">Continue</v-btn>

					<v-btn text>Cancel</v-btn>
				</v-stepper-content>
			</v-stepper-items>
		</v-stepper>
	</v-app>
</template>

<script>
export default {
	data() {
		return {
			e1: 2,
			academicYears: ["2018/2019 Session", "2019/2020 Session"],
			academicYearName: "",
			newAcademicYearName: "",
			newSemesterName: "",
			semesterName: "",
			semesterTypes: ["Alpha Semester", "Omega Semester"],
			isNew: false,
			isNewSemester: false,
			startDate: new Date().toISOString().substr(0, 10),
			endDate: new Date().toISOString().substr(0, 10),
			semesterStartDate: new Date().toISOString().substr(0, 10),
			semesterEndDate: new Date().toISOString().substr(0, 10),
			menu2: false,
			menu3: false,
			menu4: false,
			menu5: false
		};
	},
	methods: {
		submitAcademicYear() {
			this.e1 = 2;
		}
	},
	watch: {
		academicYearName(cVal) {
			if (cVal == "Create New Academic Year") {
				this.isNew = true;
			} else {
				this.isNew = false;
			}
			// console.log(pVal, cVal);
		},
		startDate(val) {
			console.log(val);
		},
		semesterName(cVal) {
			if (cVal == "Create New Semester Type") {
				this.isNewSemester = true;
			} else {
				this.isNewSemester = false;
			}
			// console.log(pVal, cVal);
		}
	}
};
</script>
