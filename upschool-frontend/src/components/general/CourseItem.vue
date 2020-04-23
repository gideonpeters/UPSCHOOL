<template>
	<div>
		<v-card
			flat
			class="d-flex flex-column pa-4 pointer"
			@click="goToPage(course.id)"
			min-height="180"
			max-height="300"
		>
			<div class="d-flex justify-space-between align-center">
				<div class="font-weight-bold">{{ course.course_code }}</div>
				<div class="d-flex align center" v-if="!isStudent">
					<v-icon size="18" class="mr-1" color="grey">mdi-pencil</v-icon>
					<v-icon size="18" color="grey">mdi-delete</v-icon>
				</div>
			</div>
			<div class="fs-3 mt-2 mb-5">{{ course.title }}</div>
			<v-spacer></v-spacer>
			<v-divider></v-divider>
			<div class="d-flex justify-space-between align-center mt-2">
				<div class="d-flex align-center">
					<div>
						<v-icon size="10" color="yellow accent-4">mdi-circle</v-icon>
					</div>
					<!-- <div class="fs-4 ml-2">Departmental Course</div> -->
				</div>
				<div class="fs-4 d-flex">
					<div class="mr-3" v-if="personal">{{2 +' Units'}}</div>
					<div class="font-italic">{{course.semester_type ? course.semester_type.short_title : ''}}</div>
				</div>
			</div>
		</v-card>
	</div>
</template>

<script>
export default {
	props: {
		course: {
			type: Object
		},
		personal: {
			type: Boolean,
			default: false
		},
		isStaff: {
			type: Boolean,
			default: false
		},
		isStudent: {
			type: Boolean,
			default: false
		},
		isAdmin: {
			type: Boolean,
			default: false
		}
	},
	methods: {
		goToPage(v) {
			if (this.isStudent) {
				return this.$router.push({
					name: "student.courses.view",
					params: { id: v }
				});
			} else if (this.isStaff) {
				return this.$router.push({
					name: "staff.courses.view",
					params: { id: v }
				});
			}
			return this.$router.push({
				name: "parent.courses.view",
				params: { id: v }
			});
		}
	}
};
</script>