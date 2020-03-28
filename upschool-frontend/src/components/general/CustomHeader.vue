<template>
	<div>
		<!-- <div class="d-flex justify-space-between">
      <div class="sub-text">
        {{ title }}
      </div>
      <div
        class="cta-text text-right pointer"
        @click="goToPage"
      >
        {{ ctaText }}
        <v-icon
          size="20"
          color="#683587"
        >
          mdi-chevron-right
        </v-icon>
      </div>
    </div>
    <v-divider class="my-3" />
		-->

		<div class="d-flex align-baseline">
			<div>
				<v-subheader class="pa-0">{{title}}</v-subheader>
			</div>
			<v-spacer></v-spacer>
			<div
				class="d-flex align-center grey--text pointer fs-4 font-weight-medium"
				@click="goToPage(route)"
			>
				<div class="mr-1">{{ctaText}}</div>
				<v-icon size="14" color="grey" v-if="ctaText">mdi-arrow-right</v-icon>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		title: {
			type: String
		},
		ctaText: {
			type: String
		},
		route: {
			type: String
		}
	},
	methods: {
		goToPage() {
			if (!this.route) return;
			this.$router.push({
				name: this.route
			});
		}
	}
};
</script>
