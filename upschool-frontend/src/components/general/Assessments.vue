<template>
	<v-card flat class="pa-3" min-height="500">
		<!-- <div> -->
		<v-btn x-small text color="black" @click="goBack">Go Back</v-btn>
		<metric-card title="Numer of school assessments" :value="schoolAssessments.length" />
		<div class="d-flex justify-space-between align-center">
			<h3>{{schoolAssessments.reduce((acc, val) => acc + val.total_score, 0)}} Marks</h3>
		</div>
		<v-data-table :headers="headers" :items="items">
			<template v-slot:item.score="props">
				<div>{{itemScore(props)}}</div>
			</template>
		</v-data-table>
	</v-card>
</template>

<script>
// import DownloadCsv from "vue-json-csv";
import axios from "axios";
// import Papa from "papaparse";
import MetricCard from "@/components/parent/Metric";

export default {
	components: {
		// DownloadCsv,
		MetricCard
	},
	data() {
		return {
			items: [],
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
				// { text: "Registration Number", value: "student.reg_number" },
				{ text: "Program", value: "student.program.name" }
			]
		};
	},
	computed: {
		schoolAssessments() {
			return this.$store.state.schoolAssessments;
		}
	},
	methods: {
		goBack() {
			let id = this.$route.params.id;
			let route = "parent.courses.view.grades";

			this.$router.push({ name: route, params: { id: id } });
		},
		itemScore(props) {
			let res = props.item.school_assessment_items.find(
				it => it.school_assessment_id == props.header.assessment_id
			);

			res ? (res = res.score) : (res = 0);
			return res;
		}
	},
	async mounted() {
		try {
			if (this.schoolAssessments.length == 0) {
				await this.$store.dispatch("getSchoolAssessments");
			}

			if (this.schoolAssessments.length > 0) {
				this.schoolAssessments.forEach(item => {
					return this.headers.push({
						text: `${item.name} (${item.total_score} Marks)`,
						value: "score",
						sortable: true,
						assessment_id: item.id
					});
				});
			}

			let id = this.$route.params.id;
			let res = await axios.get(
				`school-assessment-items?course_id=${id}`
			);
			// console.log(res.data);

			this.items = res.data.data;
		} catch (error) {
			throw error;
		}
	}
};
</script>