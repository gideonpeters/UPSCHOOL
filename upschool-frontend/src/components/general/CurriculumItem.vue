<template>
	<div class="mt-3">
		<v-subheader
			class="pa-0 text-uppercase"
			v-if="curriculumItem.filter(item => item.course_status_id == status.id).length > 0"
		>{{status.name}}</v-subheader>
		<v-data-table
			:headers="headers"
			v-if="curriculumItem.filter(item => item.course_status_id == status.id).length > 0"
			:items="curriculumItem.filter(item => item.course_status_id == status.id)"
			class="elevation-1"
		>
			<template v-slot:item.completed="{ item }">
				<v-simple-checkbox :value="!!item" disabled></v-simple-checkbox>
			</template>
			<template v-slot:item.prerequisites="{item}">
				<div class="py-1" v-for="(subItem, i) in item.curriculumable.prerequisites" :key="i">
					<v-chip>{{ subItem.course_code }}</v-chip>
				</div>
			</template>
			<template v-slot:item.semester="{item}">
				<div class="py-1">{{item}}</div>
			</template>
		</v-data-table>
	</div>
</template>

<script>
export default {
	props: {
		curriculumItem: {
			type: Array
		},
		level: {
			type: String
		},
		status: {
			type: Object
		}
	},
	data() {
		return {
			courses: [],
			headers: [
				{
					text: "Course Code",
					align: "start",
					sortable: false,
					value: "curriculumable.course_code"
				},
				{ text: "Course Title", value: "curriculumable.title" },
				{ text: "Credit Unit", value: "credit_unit" },
				{
					text: "Semester",
					value: "curriculumable.semester_type.short_title"
				},
				{ text: "Prerequisite", value: "prerequisites" },
				{ text: "Completed", value: "completed" }
			]
		};
	},
	computed: {},
	methods: {
		getCourseById(id) {
			return this.$store.getters.getCourseById(id);
		},
		getSemesterById(id) {
			return this.$store.getters.getSemesterById(id);
		},
		curriculumType(typeId) {
			return this.$store.state.curriculum_types.find(
				item => item.id == typeId
			);
		},
		isCompleted() {
			return true;
		}
	}
};
</script>