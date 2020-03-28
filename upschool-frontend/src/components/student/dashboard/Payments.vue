<template>
  <div>
    <v-card
      flat
      round
      class="py-3 px-5"
    >
      <custom-header
        title="Next Payment"
        cta-text="View Payments"
        route="student.payments"
      />
      <div class="d-flex flex-column">
        <div class="price">
          NGN850,000.00
        </div>
        <div class="d-flex justify-content-between py-3">
          <div>
            <div class="h-text">
              Payment Type
            </div>
            <div class="body-text">
              Academic Fees
            </div>
          </div>
          <div class="ml-auto">
            <div class="h-text">
              Date Due
            </div>
            <div class="body-text">
              15-March-2020
            </div>
          </div>
        </div>
        <div class="mt-3">
          <v-btn
            height="30"
            depressed
            color="#59C203"
            class="course-btn text--white text-none"
          >
            Make Payment
          </v-btn>
        </div>
      </div>
    </v-card>
  </div>
</template>

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
