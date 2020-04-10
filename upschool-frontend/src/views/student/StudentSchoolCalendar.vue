<template>
	<v-app>
		<school-calendar isStudent />
	</v-app>
</template>

<script>
import SchoolCalendar from "./../../components/general/SchoolCalendar";
export default {
	components: {
		SchoolCalendar
	}
};
</script>