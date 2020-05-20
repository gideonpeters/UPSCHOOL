<template>
	<v-app>
		<application-view isAdmin />
	</v-app>
</template>

<script>
import ApplicationView from "@/components/general/application-view/ApplicationView";
export default {
	components: {
		ApplicationView,
	},
};
</script>
