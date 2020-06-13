<template>
	<div>
		<v-card flat class="pa-3" min-height="500">
			<v-card-text>
				<div class="my-4 subtitle-1">Description</div>

				<div>{{ course.description }}</div>
				<!-- <v-row align="center" class="mx-0 mt-5"> -->
				<div class="d-flex flex-lg-row flex-column">
					<div class="py-3 pr-4">CLASSES:</div>
					<!-- <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating> -->

					<div
						class="grey--text d-flex flex-lg-row flex-column align-start align-lg-center"
						:class="i < 2 ? 'pr-4': ''"
						v-for="i in 2"
						:key="i"
					>
						Mondays 8:00AM -10PM
						<v-icon v-if="!isStudent" size="15" class="px-2">mdi-close-circle</v-icon>

						<v-icon v-if="!isStudent" size="15">mdi-pencil</v-icon>
					</div>
				</div>

				<v-spacer></v-spacer>
				<v-btn color="primary" outlined v-if="!isStudent">ADD CLASS</v-btn>
				<!-- </v-row> -->
			</v-card-text>

			<v-divider class="mx-4"></v-divider>
			<v-row align="center">
				<v-card-title>Prerequisites</v-card-title>
				<v-spacer></v-spacer>
				<v-btn color="success" text v-if="!isStudent">ADD PREREQUISITE</v-btn>
			</v-row>

			<v-card-text>
				<v-chip-group active-class="deep-purple accent-4 white--text" column>
					<v-chip
						v-for="prerequisite in course.prerequisites"
						:key="prerequisite.id"
					>{{ prerequisite.course_code }}</v-chip>
					<v-chip
						v-if="course.prerequisites && course.prerequisites.length == 0"
					>No prerequisites for this course</v-chip>
				</v-chip-group>
			</v-card-text>

			<v-card-text>
				<v-row>
					<div class="mb-4 subtitle-1">Facilitators</div>
					<v-spacer></v-spacer>

					<v-btn color="success" text v-if="!isStudent">ADD FACILITATOR</v-btn>
				</v-row>

				<div
					class="d-flex align-center"
					v-for="facilitator in course.facilitators"
					:key="facilitator.id"
				>
					<v-btn
						v-if="isAdmin"
						@click="selectedStaff = facilitator, confirmRemove = true"
						color="grey"
						icon
						class="mr-2"
					>
						<v-icon small color="grey">mdi-close-circle</v-icon>
					</v-btn>
					{{ facilitator.name }}
				</div>
				<div class="d-flex align-center" v-if="course.facilitators && course.facilitators.length == 0">
					<p>No facilitators registered for this course yet</p>
				</div>
				<v-dialog v-model="confirmRemove" max-width="290">
					<v-card>
						<v-card-title></v-card-title>
						<v-card-text v-if="selectedStaff">
							Are you sure you want to remove
							<b>{{selectedStaff.name}}</b> as facilitator
						</v-card-text>

						<v-card-actions>
							<v-spacer></v-spacer>

							<v-btn color="red darken-1" text @click="confirmRemove = false">Cancel</v-btn>

							<v-btn color="green darken-1" text @click="unEnrollStaff">Proceed</v-btn>
						</v-card-actions>
					</v-card>
				</v-dialog>
			</v-card-text>

			<v-card-actions>
				<div class="d-flex flex-lg-row flex-column">
					<div v-if="isStudent">
						<v-btn color="deep-purple lighten-2" text disabled v-if="isStudent">Enrolled as Student</v-btn>
					</div>
					<div>
						<v-btn
							color="deep-purple lighten-2"
							text
							@click="dialog = true"
							v-if="!isStudent"
						>Enroll as Staff/Facilitator</v-btn>
					</div>
				</div>
			</v-card-actions>
		</v-card>
		<v-dialog v-model="dialog" persistent max-width="600px">
			<!-- <template v-slot:activator="{ on }">
				<v-btn depressed icon v-on="on">
					<v-icon small>mdi-eye</v-icon>
				</v-btn>
			</template>-->
			<v-card>
				<v-card-title>
					<span class="headline">Enroll as Facilitator</span>
				</v-card-title>
				<v-card-text>
					<v-container>
						<v-row>
							<v-col cols="12">
								<v-text-field :value="`${course.course_code} : ${course.title}`" outlined disabled></v-text-field>
							</v-col>
							<v-col cols="12" sm="12" v-if="isAdmin">
								<v-autocomplete
									outlined
									v-model="selectedStaff"
									item-text="name"
									return-object
									chips
									:items="staff"
									label="Select Facilitators"
								></v-autocomplete>
							</v-col>
							<v-col cols="12">
								<v-text-field outlined v-model="enrollmentKey" type="text" label="Enrollment Key"></v-text-field>
							</v-col>
						</v-row>
					</v-container>
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn
						color="blue darken-1"
						text
						@click="dialog = false, enrollmentKey = '', selectedStaff = {}"
					>Cancel</v-btn>
					<v-btn
						color="green darken-1"
						text
						:disabled="!(selectedStaff && enrollmentKey)"
						@click="enrollStaff"
					>Proceed</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</div>
</template>

<script>
import Axios from "axios";
export default {
	props: {
		isStudent: {
			type: Boolean,
			default: false
		},
		isStaff: {
			type: Boolean,
			default: false
		},
		isAdmin: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			course: {},
			selectedStaff: null,
			enrollmentKey: "",
			dialog: null,
			staff: [],
			confirmRemove: null
		};
	},
	methods: {
		reserve() {},
		async enrollStaff() {
			try {
				let body = {
					course_id: this.$route.params.id,
					staff_id: this.selectedStaff.id,
					staff_key: this.enrollmentKey
				};

				let res = await Axios.post("enroll/staff", body);
				console.log(res.data);

				this.$store.commit("openSnackbar", res.data.message);
				this.getCourse();
				this.selectedStaff = {};
				this.enrollmentKey = "";

				this.dialog = false;
			} catch (error) {
				console.log(error);
			}
		},
		async unEnrollStaff() {
			try {
				let body = {
					course_id: this.$route.params.id,
					staff_id: this.selectedStaff.id
				};

				let res = await Axios.post("unenroll/staff", body);
				console.log(res.data);
				this.confirmRemove = false;

				this.$store.commit("openSnackbar", res.data.message);
				this.getCourse();
			} catch (error) {
				console.log(error);
			}
		},
		async getStaff() {
			try {
				// let res = await Axios.get("staff");
				// console.log(res.data);
				// this.staff = res.data.data;
			} catch (error) {
				console.log(error);
			}
		},
		async getCourse() {
			try {
				let id = this.$route.params.id;

				this.course = await this.$store.dispatch("getCourseById", id);
			} catch (error) {
				console.log(error);
			}
		}
	},
	async mounted() {
		try {
			this.getCourse();
			this.getStaff();
			// this.getCourseSections();
			// this.getCourseParticipants();
			// this.getGradelists();
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
