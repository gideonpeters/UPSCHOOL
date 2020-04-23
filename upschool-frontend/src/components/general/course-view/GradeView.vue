<template>
	<v-card flat class="pa-3" min-height="500">
		<!-- <div> -->
		<v-btn x-small text color="black" @click="goBack">Go Back</v-btn>
		<div class="d-flex justify-space-between align-center">
			<h3>{{ gradeList.name }} ({{gradeList.total_score }} Marks)</h3>

			<v-menu offset-y>
				<template v-slot:activator="{ on }">
					<v-btn v-on="on" depressed icon>
						<v-icon color="grey">mdi-dots-vertical</v-icon>
					</v-btn>
				</template>
				<v-list>
					<v-list-item v-for="(item,index) in gradeActions" :key="index" @click="item.fn">
						<v-list-item-title>
							<download-csv :name="fileTitle" v-if="index == 0" :data="csvData">
								<!-- <v-btn color="primary" text> -->
								{{
								item.title
								}}
								<!-- </v-btn> -->
							</download-csv>
							<div v-else>
								{{
								item.title
								}}
							</div>
						</v-list-item-title>
					</v-list-item>
				</v-list>
			</v-menu>
		</div>
		<small class="fs-6 blue--text">Scores higher than the total score will not be uploaded</small>
		<!-- <v-spacer></v-spacer> -->
		<!-- </div> -->

		<div>
			<v-card flat class="pa-3" min-height="500">
				<v-data-table :headers="headers" :items="gradeList.grade_items" hide-default-footer>
					<template v-slot:item.action="{}">
						<v-btn depressed tile>Action</v-btn>
					</template>
					<template v-slot:item.score="{item}">
						<v-edit-dialog
							:return-value.sync="item.score"
							@save="saveScore(item.score)"
							@cancel="cancel"
							@open="openScoreEdit"
							@close="closeScoreEdit"
						>
							{{ item.score }}
							<template v-slot:input>
								<v-text-field
									ref="score"
									v-model="item.score"
									:rules="[maxScore]"
									label="Edit Score"
									single-line
									counter
								></v-text-field>
							</template>
						</v-edit-dialog>
					</template>
				</v-data-table>
			</v-card>
		</div>

		<v-dialog v-model="dialogUpload" persistent max-width="600px">
			<v-card>
				<v-card-title>
					<span class="headline">Upload Scores</span>
				</v-card-title>
				<v-card-text>
					<v-container>
						<v-row>
							<v-col cols="12" sm="6" md="6">
								<v-text-field outlined label="Grade" :value="'Pop Quiz 1'" disabled></v-text-field>
							</v-col>
							<v-col cols="12" sm="6" md="12">
								<v-file-input
									show-size
									outlined
									prepend-icon
									prepend-inner-icon="mdi-paperclip"
									accept=".csv"
									@change="showCsv"
									label="Select CSV File"
									persistent-hint
									hint="make sure you use template you exported!"
								></v-file-input>
							</v-col>
						</v-row>
					</v-container>
					<small>*indicates required field</small>
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="blue darken-1" text @click="dialogUpload = false">Close</v-btn>
					<v-btn color="blue darken-1" text @click="uploadScores">Save</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>

		<v-dialog v-model="dialogDelete" persistent max-width="600px">
			<!-- <template v-slot:activator="{ on }">
				<v-btn color="primary" v-on="on" depressed text v-if="!isStudent">Add Section</v-btn>
			</template>-->
			<v-card>
				<v-card-title>
					<span class="headline">Confirm</span>
				</v-card-title>
				<v-card-text>
					<v-container>
						<v-row>
							<div class="fs-3">Are you sure you want to delete this gradelist?</div>
						</v-row>
					</v-container>
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="blue darken-1" text @click="dialogDelete = false">Cancel</v-btn>
					<v-btn color="blue darken-1" text @click="deleteGrade">Proceed</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>

		
	</v-card>
</template>

<script>
import DownloadCsv from "vue-json-csv";
import axios from "axios";
import Papa from "papaparse";

export default {
	components: {
		DownloadCsv
	},
	data() {
		return {
			participants: [],
			dialogUpload: null,
			maxScore: v =>
				v <= this.gradeList.total_score ||
				"Has to be within total score value",
			dialogSubmitAssessment: null,
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
				{ text: "Registration Number", value: "student.reg_number" },
				{ text: "Program", value: "student.program.name" },
				// { text: "Residence", value: "residence" },
				{ text: "Score", value: "score", sortable: false }
			],
			gradeActions: [
				{ id: 1, title: "Export CSV", fn: () => {} },
				{
					id: 2,
					title: "Upload Scores",
					fn: () => (this.dialogUpload = true)
				},
				{
					id: 3,
					title: "Delete Gradelist",
					fn: () => (this.dialogDelete = true)
				},
				{ id: 4, title: "Refresh Scores", fn: () => {} }
			],
			model: [
				{
					name: "",
					matric_number: "",
					score: ""
				}
			],
			dialogDelete: null,
			gradeList: [],
			
		};
	},
	computed: {
		csvData() {
			let res;
			if (this.gradeList.grade_items) {
				res = this.gradeList.grade_items.map(item => ({
					// ...item
					matric_number: item.student.matric_number,
					score: item.score
					// semester: item.semester.name, //item.address.city,
					// category: item.category.name //item.company.name
				}));
			}
			return res;
		},
		fileTitle() {
			let res;
			if (this.gradeList.course) {
				res = `${this.gradeList.course.course_code}_${this.gradeList.name}.csv`;
			}
			return res;
		}
	},
	methods: {
		openSubmitAssessment(item) {
			this.selectedAssessment = item;
			this.dialogSubmitAssessment = true;
		},
		submitAssessment() {
			this.dialogSubmitAssessment = false;
		},
		goBack() {
			let id = this.$route.params.grade_id;
			let route = "parent.courses.view.grades";

			this.$router.push({ name: route, params: { grade_id: id } });
		},
		async deleteGrade() {
			try {
				this.dialogDelete = false;
				let id = this.$route.params.grade_id;
				let res = await axios.delete(`gradelist/${id}`);

				if (res.data.status) {
					let idd = this.$route.params.id;
					this.$router.push({
						name: "staff.courses.view.grades",
						params: { id: idd }
					});
				}

				this.$store.commit("openSnackbar", res.data.message);
			} catch (error) {
				console.log(error);
			}
		},
		async getGradeList() {
			try {
				let id = this.$route.params.grade_id;
				let res = await axios.get(`gradelist/${id}`);
				console.log(res.data);

				this.gradeList = res.data.data;
			} catch (error) {
				console.log(error);
			}
		},
		async showCsv(ent) {
			var reader = new FileReader();

			reader.readAsText(ent);
			reader.onload = async evt => {
				let res = await Papa.parse(evt.target.result, {
					header: true,
					skipEmptyLines: true
				});

				this.dummy = res.data;
			};
		},
		async uploadScores() {
			this.dialogUpload = false;
			if (this.dummy.length > 0) {
				let id = this.$route.params.grade_id;
				let body = { data: JSON.stringify(this.dummy) };
				// console.log(body);
				let res = await axios.post(`gradelist-upload/${id}`, body);
				// if (res.data.status) {
				if (res.data.status) {
					this.getGradeList();
				}
				this.$store.commit("openSnackbar", res.data.message);
				// }
			} else {
				this.$store.commit("openSnackbar", "No records uploaded");
			}
		},
		saveScore(v) {
			console.log(this.$refs.score.value);
			this.$store.commit("openSnackbar", "Score saved!");
		},
		cancel() {},
		openScoreEdit() {},
		closeScoreEdit() {
			// console.log('Dialog closed')
		}
	},
	async mounted() {
		try {
			this.getGradeList();
			// this.getCourseParticipants();
		} catch (error) {
			console.log(error);
		}
	}
};
</script>