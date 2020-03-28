<template>
	<v-app>
		<div class="my-5 align-center d-flex">
			<v-icon size="20" class="mr-2" @click="$router.go(-1)">mdi-arrow-left</v-icon>Events & Attendance/
			<span v-if="event">{{event.name}}</span>
		</div>

		<v-row>
			<v-col cols="12" sm="12" md="6">
				<v-text-field
					v-model="search"
					append-icon="mdi-magnify"
					label="Search"
					single-line
					hide-details
				></v-text-field>
			</v-col>
			<v-col cols="12">
				<v-card flat class="pa-3">
					<v-subheader>ATTENDEES</v-subheader>

					<v-data-table
						:headers="headers"
						:items="students"
						:search="search"
						sort-by="calories"
						@click:row="goToPage"
						:items-per-page="5"
					>
						<template
							v-slot:item.percentage="{ item }"
						>{{((item.weighted_attendance / event.total_attendance ) * 100).toFixed(2)}}</template>
					</v-data-table>
				</v-card>
			</v-col>
		</v-row>
	</v-app>
</template>

<script>
export default {
	data() {
		return {
			search: "",
			headers: [
				{
					text: "NAME",
					align: "start",
					sortable: false,
					value: "name"
				},
				{ text: "MATRICULATION NUMBER", value: "matric_number" },
				{ text: "REG NUMBER", value: "reg_number" },
				{ text: "DEPARTMENT", value: "department" },
				{ text: "RESIDENCE", value: "residence" },
				{ text: "WEIGHTED ATTENDANCE", value: "weighted_attendance" },
				{ text: "PERCENTAGE(%)", value: "percentage" }
				// { text: "WEIGHTED SCORE", value: "protein" }
			],
			event: []
		};
	},
	computed: {
		students() {
			return this.event.students;
		}
	},
	mounted() {
		let id = this.$route.params.id;
		this.event = this.$store.getters.getEvent(id);
	},
	methods: {
		goToPage(v) {
			this.$router.push({
				name: "parent.attendance-view",
				params: { id: v.matric_number }
			});
		}
	}
};
</script>