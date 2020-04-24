<template>
	<v-app>
		<news-view isAdmin />
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
