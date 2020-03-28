<template>
	<v-app>
		<!-- <h1>Admin News</h1> -->

		<news-view />
	</v-app>
</template>

<script>
import NewsView from "@/components/general/NewsView";
export default {
	components: {
		NewsView
	}
};
</script>