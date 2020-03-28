<template>
  <button
    :style="{'background-color': customBg}"
    class="btn"
    :class="btnClass"
    :disabled="disabled"
    @click="emitClick"
  >
    <slot />
  </button>
</template>
<script>
export default {
	props: {
		accent: {
			type: Boolean,
			default: false
		},
		outline: {
			type: Boolean,
			default: false
		},
		flat: {
			type: Boolean,
			default: false
		},
		block: {
			type: Boolean,
			default: false
		},
		disabled: {
			type: Boolean,
			default: false
		},
		tile: {
			type: Boolean,
			default: false
		},
		success: {
			type: Boolean,
			default: false
		},
		small: {
			type: Boolean,
			default: false
		},
		large: {
			type: Boolean,
			default: false
		},
		light: {
			type: Boolean,
			default: false
		},
		customBg: {
			type: String
		}
	},
	computed: {
		btnClass() {
			return {
				accent: this.accent,
				"btn-outline": this.outline,
				"btn-flat": this.flat,
				"btn-block": this.block,
				"btn-tile": this.tile,
				success: this.success,
				"btn-small": this.small,
				"btn-large": this.large,
				light: this.light
			};
		}
	},
	methods: {
		emitClick(e) {
			this.$emit("click", e);
		}
	}
};
</script>