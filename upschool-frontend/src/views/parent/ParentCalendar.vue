<template>
	<v-app>
		<calendar isAdmin />
	</v-app>
</template>

<script>
import Calendar from "@/components/general/Calendar";
export default {
	components: { Calendar },
};
</script>
