<template>
	<v-app>
		<staff-profile isStaff :staff="staff" />
	</v-app>
</template>

<script>
import StaffProfile from "@/components/general/StaffProfile";
export default {
	components: {
		StaffProfile
	},
	data() {
		return {
			// staff: null
		};
	},
	computed: {
		staff() {
			let id = this.$route.params.id;
			let res;
			if (id) {
				res = this.$store.getters.getStaffById(id);
			} else {
				res = this.$store.state.loggedInUser;
			}
			return res;
		}
	},
	async mounted() {
		try {
			await this.$store.dispatch("getStaff");
		} catch (error) {
			console.log(error);
		}
	}
};
</script>
