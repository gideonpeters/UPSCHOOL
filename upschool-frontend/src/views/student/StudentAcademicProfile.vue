<template>
	<v-app>
		<student-profile :student="student" isStudent />
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
				// id = this.$store.state.loggedInUser.matric_number;
				return this.$store.state.loggedInUser;
			}
			return this.$store.getters.getStudent(id);
		}
	}
};
</script>

<style lang="scss" scoped>
.profile-img {
	border-radius: 10px;
}
</style>
