<template>
	<div>
		<v-row>
			<v-col cols="12" md="4" v-if="!$vuetify.breakpoint.mdAndUp ? !showFirstStep : true">
				<v-card flat height="550">
					<v-list>
						<v-subheader>INBOX</v-subheader>
						<v-list-item v-for="(item, i) in messageList" :key="i" @click.stop="showMessageList(item.id)">
							<v-list-item-avatar>
								<v-img :src="item.avatar">
									<template v-slot:placeholder>
										<v-row class="fill-height grey ma-0" align="center" justify="center">
											<div class="headline text-center text-bold">{{ item.title[0] }}</div>
										</v-row>
									</template>
								</v-img>
							</v-list-item-avatar>

							<v-list-item-content>
								<v-list-item-title v-text="item.title"></v-list-item-title>
								<div class="fs-5 text-truncate mt-2">{{ item.last_message }}</div>
							</v-list-item-content>
							<v-list-item-icon>
								<v-icon small color="grey" class="mr-2">mdi-clock</v-icon>
								{{
								moment().diff(
								moment(item.last_sent),
								"days"
								) < 1
								? moment(item.last_sent).format("LT")
								: moment().diff(
								moment(item.last_sent),
								"days"
								) == 1
								? moment(
								moment(item.last_sent).format()
								).calendar(moment(), {
								lastDay: "[Yesterday]",
								})
								: moment(item.last_sent).format("L")
								}}
							</v-list-item-icon>
						</v-list-item>
					</v-list>
				</v-card>
			</v-col>
			<v-col v-if="!$vuetify.breakpoint.mdAndUp ? showFirstStep : true">
				<v-card v-if="!currentMessageList" class="d-flex justify-center align-center" flat height="500">
					<div class="font-weight-light fs-2">
						{{
						messageList.length > 0
						? "Select message to begin"
						: "You have no messages"
						}}
					</div>
				</v-card>
				<v-card flat v-else class="d-flex flex-column pa-3" min-height="550" max-height="500">
					<div class="d-flex align-center">
						<div v-if="!$vuetify.breakpoint.mdAndUp" @click="showFirstStep = false">
							<v-icon size="18" class="mr-2">mdi-arrow-left</v-icon>
						</div>
						<div>
							<h2 class="font-weight-light">{{ currentMessageList.title }}</h2>
							<div class="fs-6">
								<v-icon size="8" class="mr-1" color="yellow">mdi-circle</v-icon>Undergraduate
							</div>
						</div>
					</div>
					<v-divider class="mb-5 mt-2"></v-divider>

					<v-card
						flat
						class="d-flex flex-column mb-auto"
						v-chat-scroll
						max-height="500"
						style="overflow-y: auto"
					>
						<div
							class="d-flex flex-column mb-1"
							:class="
								message.sender_id == userId
									? 'align-end'
									: 'align-start'
							"
							v-for="message in messages"
							:key="message.id"
						>
							<v-card
								flat
								tile
								max-width="45%"
								:class="
									message.sender_id == userId
										? 'blue rounded--0'
										: 'green accent-4 rounded--1'
								"
								class="px-4 py-2 white--text fs-3 font-weight-light d-flex align-end"
							>
								<div>{{ message.body }}</div>
								<div class="fs-6 ml-4 text-no-wrap">
									<v-spacer></v-spacer>
									{{
									moment(message.created_at).format("LT")
									}}
								</div>
							</v-card>
						</div>
					</v-card>

					<v-card flat class="d-flex flex-column mt-auto">
						<v-textarea
							v-model="body"
							prepend-inner-icon="mdi-paperclip"
							append-icon="mdi-send mdi-rotate-270"
							solo
							@click:append="sendMessage"
							name="input-7-4"
							label="Type here..."
							hint="Press Enter to send"
						/>
					</v-card>
					<!-- </div> -->
				</v-card>
			</v-col>
		</v-row>
	</div>
</template>

<script>
import Axios from "axios";
export default {
	props: {
		messageList: { type: Array }
	},
	data: () => ({
		currentMessageList: {},
		showFirstStep: false,
		body: "",
		messages: []
	}),
	computed: {
		userId() {
			let res = 0;
			if (this.$store.state.loggedInUser.id) {
				res = this.$store.state.loggedInUser.user.id;
			}
			return res;
		}
	},
	methods: {
		prevSender() {},
		nextSender() {},
		showMessageList(id) {
			var item = this.messageList.find(item => {
				return item.id == id;
			});
			this.currentMessageList = item;
			this.messages = this.currentMessageList.messages;
			// console.log(this.messages);
			// this.listenToMessagelist();

			this.showFirstStep = !this.showFirstStep;
			return;
		},

		async sendMessage() {
			try {
				if (!this.body) {
					return alert("you have to send a message");
				}
				let body = {
					body: this.body,
					sender_id: this.userId,
					conversation_id: this.currentMessageList.id
				};

				let res = await Axios.post("messages", body);

				console.log(res.data);
				if (res.data.status) {
					// this.currentMessageList.last_message = this.body;
					this.body = "";
					// this.listenToMessagelist();
					// console.log(`conversation.${this.currentMessageList.id}`);
				}
			} catch (error) {
				console.log(error);
			}
		}
	},
	beforeMount() {
		// this.currentMessageList = this.messageList[this.messageList.length - 1];
	},
	async mounted() {
		try {
			// if (this.messageList.length > 0) {
			// if (this.currentMessageList) {
			// }
		} catch (error) {
			console.log(error);
		}
	},
	watch: {
		currentMessageList(v) {
			this.messages = [...v.messages];
			window.Echo.join(`conversation.${v.id}`).listen(
				".messageSent",
				e => {
					//
					this.messages.push(e.message);
					this.currentMessageList.last_sent = e.message.created_at;
					this.currentMessageList.last_message = e.message.body;
					console.log(e, "sent you a message");
				}
			);
		}
	}
};
</script>

<style lang="scss" scoped>
.rounded--0 {
	border-radius: 15px 15px 0px 15px;
}

.rounded--1 {
	border-radius: 15px 15px 15px 0px;
}
</style>
