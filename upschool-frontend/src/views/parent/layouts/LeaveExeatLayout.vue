<template>
	<v-app>
		<div>
			<div class="my-5">Leave & Exeat Applications</div>

			<v-card flat class="pa-3">
				<v-tabs v-model="tab" background-color="transparent">
					<v-tab v-for="item in items" :key="item.id">{{ item.tab }}</v-tab>
				</v-tabs>

				<v-tabs-items v-model="tab">
					<v-tab-item v-for="(item, ix) in items" :key="ix"></v-tab-item>
				</v-tabs-items>
			</v-card>
		</div>
	</v-app>
</template>

<script>
export default {
	data: () => ({
		tab: null,
		items: [
			{ id: 1, tab: "EXEAT APPLICATIONS" },
			{ id: 2, tab: "LEAVE APPLICATIONS" },
			{ id: 3, tab: "EXEAT & LEAVE TYPES" },
			{ id: 4, tab: "SETTINGS" }
		],

		desserts: [],
		editedIndex: -1,
		editedItem: {
			name: "",
			calories: 0,
			fat: 0,
			carbs: 0,
			protein: 0
		},
		defaultItem: {
			name: "",
			calories: 0,
			fat: 0,
			carbs: 0,
			protein: 0
		}
	})
};
</script>