<template>
	<v-app>
		<v-container fluid class="pa-0">
			<v-row>
				<v-col cols="12">
					<v-card flat class="pa-3">
						<v-subheader class="pa-0">SCHOOL ASSESSMENT SCORES</v-subheader>
						<v-data-table :headers="asgnHeaders" :items="assessments" hide-default-footer>
							<template v-slot:item.check="{ item }">
								<v-icon
									size="15"
									:color="
										item.id == 1 ? 'blue accent-2 ' : 'grey'
									"
								>mdi-circle</v-icon>
							</template>
							<template v-slot:item.total="{ item }">
								<div>{{ item.school_assessment_items.reduce((acc, val) => acc + val.score, 0) }}</div>
							</template>
							<template v-slot:item.score="props">
								<div>{{itemScore(props)}}</div>
							</template>
						</v-data-table>
					</v-card>
				</v-col>
				<!-- <v-col cols="12">
					<div>COURSE ASSESSMENTS</div>
				</v-col>-->
				<v-col cols="12">
					<v-card flat class="pa-3">
						<v-subheader class="pa-0">COURSE ASSESSMENTS</v-subheader>
						<v-data-table :headers="headers" :items="items" hide-default-footer>
							<!-- <template v-slot:item.total="{ item }">
								<div>{{ item.school_assessment_items.reduce((acc, val) => acc + val.score, 0) }}</div>
							</template>-->
							<template v-slot:item.score="{item}">
								<div>{{item.score ? item.score : 0}}</div>
							</template>
						</v-data-table>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import Axios from "axios";
export default {
	data: () => ({
		asgnHeaders: [
			{
				text: "COURSE CODE ",
				value: "course.course_code",
				sortable: false
			},
			{
				text: "TITLE",
				align: "start",
				sortable: false,
				value: "course.title"
			}
			// { text: "CA 1 ", value: "ca1", sortable: false },
			// { text: "WEIGHT", value: "weight", sortable: false },
			// { text: "ACTIONS", value: "action", sortable: false }
		],
		headers: [
			{
				text: "COURSE CODE ",
				value: "gradelist.course.course_code",
				sortable: false
			},
			{
				text: "TITLE",
				align: "start",
				sortable: false,
				value: "gradelist.course.title"
			},
			{
				text: "NAME ",
				value: "gradelist.name",
				sortable: false
			},
			{
				text: "TOTAL SCORE",
				align: "start",
				sortable: false,
				value: "gradelist.total_score"
			},
			{
				text: "WEIGHTED SCORE",
				align: "start",
				sortable: false,
				value: "score"
			}
		],
		assessments: [],
		items: []
	}),
	methods: {
		itemScore(props, isJustId) {
			let res;
			if (isJustId == true) {
				res = this.items.find(it => it.school_assessment_id == props);
			} else {
				res = props.item.school_assessment_items.find(
					it => it.school_assessment_id == props.header.assessment_id
				);
			}

			res ? (res = res.score) : (res = 0);
			return res;
		}
	},
	async mounted() {
		try {
			let res = await Axios.get(
				`school-assessment-student?student_id=${1}`
			);

			res.data.headers.forEach(item => {
				return this.asgnHeaders.push({
					assessment_id: item.id,
					text: `${item.name} (${item.total_score} Marks)`,
					value: "score",
					align: "center"
				});
			});

			this.asgnHeaders.push({
				text: "TOTAL",
				value: "total",
				sortable: false
			});

			this.items = res.data.course;

			this.assessments = res.data.data;
			console.log(res.data);
			// console.log(headers);
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
