<template>
	<v-app>
		<inbox :messageList="messageList" />
	</v-app>
</template>

<script>
import Inbox from "@/components/general/Inbox";
export default {
	components: { Inbox },
	data() {
		return {};
	},
	computed: {
		messageList() {
			return this.$store.state.loggedInUser.messageList;
		}
	}
};
</script>
