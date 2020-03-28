<template>
	<v-app>
		<news-details isStudent />
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