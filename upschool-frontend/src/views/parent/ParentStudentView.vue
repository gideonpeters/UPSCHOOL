<template>
	<v-app>
		<div>
			<div class="my-5">
				<v-btn @click="$router.go(-1)" icon color="grey">
					<v-icon small>mdi-arrow-left</v-icon>
				</v-btn>
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