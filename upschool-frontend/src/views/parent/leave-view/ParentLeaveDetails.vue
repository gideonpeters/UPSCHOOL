<template>
	<v-app>
		<leave-view isAdmin />
	</v-app>
</template>

<script>
// import ExeatUi from "@/components/general/exeat-view/ExeatUi";
import LeaveView from "@/components/general/leave-view/LeaveView";

export default {
	components: {
		LeaveView
	},
	data() {
		return {};
	}
};
</script>