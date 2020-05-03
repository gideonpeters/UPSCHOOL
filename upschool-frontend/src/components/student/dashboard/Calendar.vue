<template>
	<div>
		<calendar />
	</div>
</template>

<script>
import Calendar from "@/components/general/Calendar";
export default {
	components: {
		Calendar,
	},
};
</script>

<style lang="scss" scoped>
$primary-color: #683587;

.price {
	font-size: 1.3rem;
	font-weight: 600;
	color: $primary-color;
}
</style>
