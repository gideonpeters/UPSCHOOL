<template>
	<v-data-table :headers="asgnHeaders" :items="items" hide-default-footer>
		<template v-slot:item.submission_status="{ item }">
			<v-chip
				small
				:class="!item.submission_status ? '' : 'white--text'"
				:color="!item.submission_status ? 'yellow accent-2 ' : 'green'"
			>{{item.submission_status ? 'Submitted' : 'Not Submitted'}}</v-chip>
			<!-- <v-simple-checkbox v-model="item.check" disabled> -->
			<!-- </v-simple-checkbox> -->
		</template>
		<template v-slot:item.total_score="{ item }">
			<div>{{ item.gradelist.total_score }} Marks</div>
		</template>
		<template v-slot:item.due_date="{ item }">
			<div>
				<div>
					{{`${moment(
					item.due_date
					).format("dddd, MMMM Do YYYY, h:mm a")}`}}
				</div>
				{{`
				(${moment(
				item.due_date
				).fromNow()})`}}
			</div>
		</template>
		<template v-slot:item.open_date="{ item }">
			<div>
				<div>
					{{`${moment(
					item.open_date
					).format("dddd, MMMM Do YYYY, h:mm a")}`}}
				</div>
				{{`
				(${moment(
				item.open_date
				).fromNow()})`}}
			</div>
		</template>
		<template v-slot:no-data>
			<div>You have no submissions</div>
		</template>
		<!-- <template v-slot:item.action="{  }">
								<v-icon small class="mr-2 pointer">mdi-eye</v-icon>
								<v-icon small class="pointer">mdi-pencil</v-icon>
		</template>-->
	</v-data-table>
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
		isDashboard: {
			type: Boolean,
			default: false
		}
	},
	data: () => ({
		submissions: [],
		asgnHeaders: [
			{
				text: "COURSE CODE ",
				value: "course.course_code",
				sortable: false
			},
			{
				text: "TOPIC",
				align: "start",
				sortable: false,
				value: "gradelist.name"
			},
			{ text: "WEIGHT", value: "total_score", sortable: true },
			{
				text: "SUBMISSION STATUS",
				value: "submission_status",
				sortable: true
			},
			// { text: "GRAING STATUS", value: "", sortable: true },
			{ text: "OPEN DATE", value: "open_date", sortable: true },
			{ text: "DUE DATE", value: "due_date", sortable: true }
			// { text: "ACTIONS", value: "action", sortable: false }
		],
		asgn: [
			{
				id: 1,
				course_code: "GST411",
				name: "GST111: Communications in English Language",
				time: "Nov 26, 2020",
				weight: "10%"
			},
			{
				id: 2,
				course_code: "EIE411",
				name: "EIE517: applied Electronics",
				time: "June 26, 2020",
				weight: "20%"
			},
			{
				id: 3,
				course_code: "CEN411",
				name: "Report on the 8051 micro controller",
				time: "Mar 31, 2020",
				weight: "20%"
			}
		]
	}),
	computed: {
		pendingSubmissions() {
			return this.submissions.filter(
				item => item.submission_status == false
			);
		},
		items() {
			if (this.isStudent && this.isDashboard) {
				return this.pendingSubmissions;
			} else if (this.isStudent && !this.isDashboard) {
				return this.submissions;
			} else if (this.isStaff && this.isDashboard) {
				return this.submissions;
			}

			return this.submissions;
		}
	},
	methods: {
		async getSubmissions() {
			try {
				// let id = this.$store.state.loggedInUser.id;

				let res = await Axios.get(`submission-user`);
				console.log(res.data);
				this.submissions = res.data.data;
			} catch (error) {
				console.log(error);
			}
		}
	},
	async mounted() {
		try {
			await this.getSubmissions();
		} catch (error) {
			console.log(error);
		}
	}
};
</script>