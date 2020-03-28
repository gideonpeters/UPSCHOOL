<template>
	<!-- <div>
    <div class="d-flex flex-column ma-3 news-item">
      <div class>
        <v-img
          class="profile-img"
          cover
          height="100"
          :src="newsItem.image"
        />
      </div>
      <div class="mt-2 news-body">
        {{ newsItem.body }}
      </div>
    </div>
	</div>-->
	<v-row align="start">
		<v-col cols="4" md="3">
			<div>
				<v-img :src="`http://127.0.0.1:8000${newsItem.image.url}`" height="150"></v-img>
			</div>
		</v-col>
		<v-col cols="8" md="9">
			<v-card flat class="d-flex flex-column" height="150">
				<v-row no-gutters>
					<v-col cols="11">
						<div class="fs-3 font-weight-bold">{{ newsItem.title }}</div>
						<v-card flat max-height="76" class="fs-4 mt-2" v-line-clamp:20="4" v-html="newsItem.body"></v-card>
					</v-col>
					<v-col cols="1">
						<div class="d-flex justify-end" v-if="!isStudent">
							<v-menu offset-y>
								<template v-slot:activator="{ on }">
									<v-btn v-on="on" depressed color="white" icon :ripple="false">
										<v-icon color="grey">mdi-dots-vertical</v-icon>
									</v-btn>
								</template>
								<v-list>
									<v-list-item v-for="(item, index) in newsActions" :key="index" @click="alert(item)">
										<v-list-item-title>
											{{
											item.title
											}}
										</v-list-item-title>
									</v-list-item>
								</v-list>
							</v-menu>
						</div>
					</v-col>
					<v-col cols="12" class="mt-auto">
						<div class="d-flex mt-auto">
							<v-spacer></v-spacer>
							<v-btn color="primary" text @click="
									goToPage(newsItem.id)
								">Read more</v-btn>
						</div>
					</v-col>
				</v-row>
			</v-card>
		</v-col>
	</v-row>
</template>

<script>
export default {
	props: {
		newsItem: {
			type: Object
		},
		isStudent: {
			type: Boolean,
			default: false
		}
	},
	data: () => ({
		newsActions: [
			{ id: 1, title: "Edit" },
			{ id: 2, title: "Delete" }
		]
		// 	img:
		// 		"https://static.wixstatic.com/media/415a35bc6e1642e2a0f53f9a1963eb1d.jpg"
	}),
	methods: {
		goToPage(id) {
			if (this.isStudent) {
				return this.$router.push({
					name: "student.news.details",
					params: { id: id }
				});
			}
			this.$router.push({
				name: "parent.news.details",
				params: { id: id }
			});
		}
	}
};
</script>

<style lang="scss" scoped>
// .profile-img {
// 	border-radius: 10px;
// }

// .news-item {
// 	height: 190px;
// 	overflow: hidden;

// 	.news-body {
// 		font-size: 0.8rem;
// 		display: -webkit-box;
// 		-webkit-line-clamp: 3;
// 		-webkit-box-orient: vertical;
// 		overflow: hidden;
// 	}
// }
</style>
