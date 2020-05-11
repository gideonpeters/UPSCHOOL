<template>
	<v-app>
		<!-- <h2>Inbox</h2> -->
		<inbox isStudent :messageList="messageList" />
	</v-app>
</template>

<script>
import Inbox from "@/components/general/Inbox";
import Axios from "axios";
export default {
	components: { Inbox },
	data: () => ({
		messageList: []
	}),
	async mounted() {
		try {
			let res = await Axios.get("conversation");
			console.log(res.data);
			this.messageList = res.data.data;
		} catch (error) {
			console.log(error);
		}
	},
	beforeDestroy() {
		this.messageList = [];
	}
};
</script>
