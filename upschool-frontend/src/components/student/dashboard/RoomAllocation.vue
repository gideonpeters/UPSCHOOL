<template>
  <div>
    <v-card
      flat
      round
      class="py-3 px-5"
    >
      <custom-header
        title="Residence"
        cta-text="View Residence"
        route="student.residence"
      />
      <div class="d-flex flex-column">
        <div class="price">
          Hall Allocated:- {{ user.hall }}
        </div>
        <div class="price">
          Room Number:- {{ user.room_number }}
        </div>
        <div class="d-flex flex-column py-3">
          <div class="h-text">
            Devices Registered
          </div>
          <div class="body-text">
            {{ user.no_of_devices }}
          </div>
        </div>
        <div class="mt-3">
          <v-btn
            height="30"
            depressed
            color="#59C203"
            class="course-btn text-none text--white"
          >
            Print Residence Form
          </v-btn>
        </div>
      </div>
    </v-card>
  </div>
</template>

<script>
export default {
	data: () => ({
		user: {
			no_of_devices: 4,
			hall: "Daniel",
			room_number: "C401"
		}
	})
};
</script>

<style lang="scss" scoped>
$primary-color: #683587;

.price {
	font-size: 1.3rem;
	font-weight: 600;
	color: $primary-color;
}

.course-btn {
	color: white;
}
</style>
