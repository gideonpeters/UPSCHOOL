<template>
	<v-app>
		<leave-ui isAdmin />
	</v-app>
</template>

<script>
import LeaveUi from "@/components/general/leave-view/LeaveUi";
export default {
	components: {
		LeaveUi
	}
};
</script>