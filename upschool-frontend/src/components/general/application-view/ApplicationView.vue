<template>
	<div>
		<div class="d-flex align-center">Leave & Exeat Applications</div>

		<div>
			<v-card flat class="pa-3 mt-5">
				<v-tabs v-model="tab" background-color="transparent">
					<v-tab :to="{name: getRoute(item.route)}" v-for="item in items" :key="item.id">{{item.tab}}</v-tab>
				</v-tabs>
				<router-view></router-view>
			</v-card>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		isStudent: {
			type: Boolean,
			default: false
		},
		isStaff: {
			type: Boolean,
			default: false
		},
		isAdmin: {
			type: Boolean,
			default: false
		}
	},
	data() {
		return {
			tab: null,
			isHovered: false,
			selection: null,
			dialog2: null,
			items: [
				{ id: 1, tab: "EXEAT APPLICATIONS", route: "exeat.view" },
				{ id: 2, tab: "LEAVE APPLICATIONS", route: "leave.view" }
			]
		};
	},
	methods: {
		getRoute(route) {
			let res;
			if (this.isAdmin) {
				res = "parent." + route;
			} else if (this.isStudent) {
				res = "student." + route;
			} else if (this.isStaff) {
				res = "staff." + route;
			}

			return res;
		}
	}
};
</script>