<template>
	<v-app>
		<!-- <h1>Manage</h1> -->
		<v-container>
			<v-row>
				<v-col cols="3">
					<metric-card title="Number of Advisees" :value="45" />
				</v-col>
				<v-col cols="3">
					<metric-card title="Approved Enrollments" :value="45" />
				</v-col>
				<v-col cols="3">
					<metric-card title="Pending Enrollments" :value="45" />
				</v-col>
				<v-col cols="3"></v-col>
				<v-col cols="12">
					<v-card>
						<v-data-table :headers="headers" :items="students" hide-default-footer></v-data-table>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</v-app>
</template>

<script>
import MetricCard from "@/components/parent/Metric";
export default {
	components: {
		MetricCard
	},
	data() {
		return {
			students: [],
			headers: [
				{ text: "NAME ", value: "student.name", sortable: false },
				{
					text: "MATRIC NUMBER",
					align: "start",
					sortable: false,
					value: "student.matric_number"
				},
				{ text: "LEVEL", value: "student.level", sortable: false },
				{ text: "PROGRAM", value: "student.program", sortable: false }
				// {
				// 	text: "REGISTERED UNITS",
				// 	value: "total_units",
				// 	sortable: false
				// },
				// {
				// 	text: "APPROVAL STATUS",
				// 	value: "approval_status",
				// 	sortable: false
				// }
			]
		};
	},
	async mounted() {
		try {
			let res = await this.$store.dispatch("getAdvisees");
			this.students = res.data;
		} catch (error) {
			console.log(error);
		}
	}
};
</script>