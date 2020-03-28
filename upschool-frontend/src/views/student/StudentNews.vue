<template>
	<v-app>
		<news-view isStudent />
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
