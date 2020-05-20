<template>
	<v-app>
		<leave-ui isAdmin />
	</v-app>
</template>

<script>
// import ExeatUi from "@/components/general/exeat-view/ExeatUi";
import LeaveUi from "@/components/general/leave-view/LeaveUi";
export default {
	components: {
		LeaveUi
	},
	data() {
		return {};
	}
};
</script>