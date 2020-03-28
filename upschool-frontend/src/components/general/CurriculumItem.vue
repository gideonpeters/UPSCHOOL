<template>
	<div class="mt-3">
		<v-subheader class="pa-0 text-uppercase">{{curriculumType(curriculumItem.type_id).name}}</v-subheader>
		<v-data-table :headers="headers" :items="curriculumItem.courses " class="elevation-1">
			<template v-slot:item.completed="{ item }">
				<v-simple-checkbox :value="!!item" disabled></v-simple-checkbox>
			</template>
			<template v-slot:item.prerequisites="{item}">
				<div class="py-1" v-for="(subItem, i) in item.prerequisites" :key="i">
					<v-chip>{{getCourseById(subItem.course_id).course_code}}</v-chip>
				</div>
			</template>
			<template v-slot:item.semester="{item}">
				<div class="py-1">{{item.semester.name}}</div>
			</template>
		</v-data-table>
	</div>
</template>

<script>
export default {
	props: {
		curriculumItem: {
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
					value: "course_code"
				},
				{ text: "Course Title", value: "title" },
				{ text: "Credit Unit", value: "credit_unit" },
				{ text: "Semester", value: "semester" },
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