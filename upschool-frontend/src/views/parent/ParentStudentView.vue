<template>
	<v-app>
		<div>
			<div class="my-5">
				<v-icon size="18" class="mr-1">mdi-arrow-left</v-icon>
				Student Information / {{student.name}}
			</div>

			<student-profile :student="student" />
		</div>
	</v-app>
</template>

<script>
import StudentProfile from "@/components/general/StudentProfile";

export default {
	components: { StudentProfile },

	computed: {
		student() {
			let id;
			id = this.$route.params.id;
			if (!id) {
				id = this.$store.state.loggedInUser.matric_number;
			}
			return this.$store.getters.getStudent(id);
		}
	}
};
</script>