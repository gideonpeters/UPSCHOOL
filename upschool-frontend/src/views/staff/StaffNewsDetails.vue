<template>
	<v-app>
		<news-details isStaff />
	</v-app>
</template>

<script>
import NewsDetails from "@/components/general/NewsDetails";
export default {
	components: {
		NewsDetails
	}
};
</script>