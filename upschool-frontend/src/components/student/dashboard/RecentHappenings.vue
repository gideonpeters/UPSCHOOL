<template>
  <div class="primary-box-shadow">
    <v-card
      flat
      round
      class="py-3 px-5"
    >
      <custom-header
        title="Recent Happenings"
        cta-text="See All"
        route="student.news"
      />
      <div class="row">
        <div
          v-for="newsItem in news"
          :key="newsItem.id"
          class="col-lg-2 col-5"
        >
          <news-item :news-item="newsItem" />
        </div>
      </div>
    </v-card>
  </div>
</template>

<script>
import NewsItem from "@/components/general/NewsItem";
export default {
	components: {
		NewsItem
	},
	data: () => ({
		img:
			"https://static.wixstatic.com/media/415a35bc6e1642e2a0f53f9a1963eb1d.jpg",
		news: [
			{
				id: 1,
				title: "Real Analysis",
				image: "https://picsum.photos/id/1/200/300",
				body:
					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
			},
			{
				id: 2,
				title: "Real Analysis II",
				image: "https://picsum.photos/id/4/200/300",
				body:
					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
			},
			{
				id: 3,
				title: "Logisitics & Statistics",
				image: "https://picsum.photos/id/8/200/300",
				body:
					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
			},
			{
				id: 4,
				title: "Numerical Analysis",
				image: "https://picsum.photos/id/10/200/300",
				body:
					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
			},
			{
				id: 5,
				title:
					"Introduction to Embedded Systems and VHDL design patterns",
				image: "https://picsum.photos/id/15/200/300",
				body:
					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
			}
		]
	})
};
</script>

<style lang="scss" scoped></style>
