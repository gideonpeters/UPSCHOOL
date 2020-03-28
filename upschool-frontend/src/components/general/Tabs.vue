<template>
  <div class="tabs">
    <div class="d-flex tab-buttons">
      <ck-button
        v-for="tab in tabs"
        :key="tab.value+'-tab'"
        tile
        outline
        light
        :class="{active: isActiveTab(tab.value)}"
        class="py-2 px-4"
        @click="activateTab(tab.value)"
      >
        {{ tab.text }}
      </ck-button>
    </div>
    <div class="border px-3 tab-content">
      <slot />
    </div>
  </div>
</template>


<script>
import ckButton from "./ckButton";

export default {
	components: {
		ckButton
	},
	props: {
		tabs: {
			type: Array,
			required: true
		},
		value: {
			type: [String, Number],
			default: 1
		}
	},
	data() {
		return {
			activeTab: this.value || this.tabs[0].value
		};
	},
	watch: {
		value(v) {
			this.$emit("input", v);
		}
	},
	methods: {
		isActiveTab(tabValue) {
			return this.activeTab === tabValue;
		},
		activateTab(tabValue) {
			this.activeTab = tabValue;
			this.$emit("input", tabValue);
		}
	}
};
</script>

<style lang="scss" scoped>
$basePx: 10px;
.tabs {
	.tab-buttons {
		position: relative;
		z-index: 2;
		.btn {
			margin-left: $basePx;
		}
		.active {
			background-color: white !important;
			// color: $primary-color !important;
			border-bottom: 1px solid transparent !important;
			font-weight: 500 !important;
		}
	}
	.tab-content {
		position: relative;
		z-index: 1;
		margin-top: -1px;
		min-height: 40vh;
	}
}
</style>