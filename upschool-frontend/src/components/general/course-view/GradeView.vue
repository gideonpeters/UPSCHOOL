<template>
	<v-card flat class="pa-3" min-height="500">
		<!-- <div> -->
		<v-btn x-small text color="black" @click="$router.go(-1)">Go Back</v-btn>
		<div class="d-flex justify-space-between align-center">
			<h3>{{ gradeList.name }}</h3>

			<v-menu offset-y>
				<template v-slot:activator="{ on }">
					<v-btn v-on="on" depressed icon>
						<v-icon color="grey">mdi-dots-vertical</v-icon>
					</v-btn>
				</template>
				<v-list>
					<v-list-item v-for="(item,index) in gradeActions" :key="index" @click="item.fn">
						<v-list-item-title>
							<download-csv :name="'GEC117_Pop_Quiz_1.csv'" v-if="index == 0" :data="csvData">
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
		<!-- <v-spacer></v-spacer> -->
		<!-- </div> -->

		<div>
			<v-card flat class="pa-3" min-height="500">
				<v-data-table :headers="headers" :items="gradeList.grade_items" hide-default-footer>
					<template v-slot:item.action="{}">
						<v-btn depressed tile>Action</v-btn>
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
			gradeList: []
		};
	},
	computed: {
		csvData() {
			return this.gradeList.grade_items.map(item => ({
				// ...item
				matric_number: item.student.matric_number,
				score: item.score
				// semester: item.semester.name, //item.address.city,
				// category: item.category.name //item.company.name
			}));
		}
	},
	methods: {
		async getCourseParticipants() {
			try {
				let id = this.$route.params.id;
				let res = await this.$store.dispatch(
					"getCourseParticipants",
					id
				);

				this.participants = [...res.data];
			} catch (error) {
				console.log(error);
			}
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
				this.$store.commit("openSnackbar", res.data.message);
				if (res.data.status) {
					this.getGradeList();
				}
				// }
			} else {
				this.$store.commit("openSnakbar", "No records uploaded");
			}
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