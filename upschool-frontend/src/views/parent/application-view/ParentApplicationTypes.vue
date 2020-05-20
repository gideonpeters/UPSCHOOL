<template>
	<v-app>
		<application-types-view isAdmin />
	</v-app>
</template>

<script>
import ApplicationTypesView from "@/components/general/application-view/ApplicationTypesView";
export default {
	components: {
		ApplicationTypesView
	}
};
</script>