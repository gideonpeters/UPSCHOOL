<template>
	<v-app>
		<news-details isAdmin />
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
