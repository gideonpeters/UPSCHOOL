<template>
	<div>
		<v-row>
			<v-col cols="12" md="4" v-if="!$vuetify.breakpoint.mdAndUp ? !showFirstStep : true">
				<v-card flat height="550">
					<v-list>
						<v-subheader>INBOX</v-subheader>
						<v-list-item v-for="(item, i) in messageList" :key="i" @click.stop="showMessageList(item.id)">
							<v-list-item-avatar>
								<v-img :src="item.avatar"></v-img>
							</v-list-item-avatar>

							<v-list-item-content>
								<v-list-item-title v-text="item.title"></v-list-item-title>
								<div class="fs-5 text-truncate mt-2">{{item.messages[item.messages.length - 1 ].text}}</div>
							</v-list-item-content>
							<v-list-item-icon>
								<v-icon
									size="18"
									v-if="item.isFavourite"
									color="yellow darken-3"
									@click="markFavourite(i)"
								>mdi-star</v-icon>
								<v-icon
									size="18"
									v-if="!item.isFavourite"
									color="yellow darken-3"
									@click="markFavourite(i)"
								>mdi-star-outline</v-icon>
							</v-list-item-icon>
						</v-list-item>
					</v-list>
				</v-card>
			</v-col>
			<v-col v-if="!$vuetify.breakpoint.mdAndUp ? showFirstStep : true">
				<v-card v-if="!currentMessageList" class="d-flex justify-center align-center" flat height="500">
					<div
						class="font-weight-light fs-2"
					>{{ messageList.length > 0 ? 'Select message to begin' : 'You have no messages'}}</div>
				</v-card>
				<v-card flat v-else class="d-flex flex-column pa-3" min-height="600" max-height="650">
					<div class="d-flex align-center">
						<div v-if="!$vuetify.breakpoint.mdAndUp" @click="showFirstStep = false">
							<v-icon size="18" class="mr-2">mdi-arrow-left</v-icon>
						</div>
						<div>
							<h2 class="font-weight-light">{{currentMessageList.title}}</h2>
							<div class="fs-6">
								<v-icon size="8" class="mr-1" color="yellow">mdi-circle</v-icon>Undergraduate
							</div>
						</div>
					</div>
					<v-divider class="mb-5 mt-2"></v-divider>

					<v-card flat class="d-flex flex-column mb-auto">
						<div
							class="d-flex flex-column mb-1"
							:class="message.sender_id == userId ? 'align-end' : 'align-start'"
							v-for="(message, indx) in currentMessageList.messages"
							:key="message.id"
						>
							<v-card
								flat
								tile
								max-width="250"
								:class="message.sender_id == userId ? 'blue rounded--0' : 'green accent-4 rounded--1'"
								class="px-4 py-2 white--text fs-3 font-weight-light d-flex"
							>{{message.text}}</v-card>
							<div
								class="fs-6"
								v-if="currentMessageList.messages[indx + 1] ? !(currentMessageList.messages[indx + 1].sender_id == message.sender_id && currentMessageList.messages[indx - 1].sender_id != message.sender_id ) : (currentMessageList.messages[indx - 1].sender_id != message.sender_id)"
							>{{message.time}} {{ message.sender_id == userId ? ' - You' : ''}}</div>
						</div>
					</v-card>

					<v-card flat class="d-flex flex-column mt-auto">
						<v-textarea
							prepend-inner-icon="mdi-paperclip"
							append-icon="mdi-send mdi-rotate-270"
							solo
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
export default {
	props: {
		messageList: { type: Array }
	},
	data: () => ({
		currentMessageList: null,
		showFirstStep: false
	}),
	computed: {
		userId() {
			return this.$store.state.loggedInUser.id;
		}
	},
	methods: {
		showMessageList(id) {
			var item = this.messageList.find(item => {
				return item.id == id;
			});
			this.currentMessageList = item;
			return (this.showFirstStep = !this.showFirstStep);
		},
		markFavourite(ix) {
			this.messageList.find((item, idx) => {
				idx === ix ? (item.isFavourite = !item.isFavourite) : "";
			});
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