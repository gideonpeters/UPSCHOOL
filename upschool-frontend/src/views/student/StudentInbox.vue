<template>
	<v-app>
		<!-- <h2>Inbox</h2> -->
		<inbox :messageList="messageList" />
	</v-app>
</template>

<script>
import Inbox from "@/components/general/Inbox";
export default {
	components: { Inbox },
	data: () => ({}),
	computed: {
		messageList() {
			return this.$store.state.loggedInUser.messageList;
		}
	}
};
</script>