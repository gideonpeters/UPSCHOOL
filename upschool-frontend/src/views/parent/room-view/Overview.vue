<template>
	<v-app>
		<overview isAdmin />
	</v-app>
</template>

<script>
import Overview from "@/components/general/room-view/Overview";

export default {
	components: {
		Overview
	}
};
</script>
