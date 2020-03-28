<template>
  <div class="primary-box-shadow">
    <v-card
      flat
      round
      class="py-3 px-5"
    >
      <custom-header
        title="Academic Profile"
        cta-text="View Profile"
        route="student.academic-profile"
      />
      <div
        class="d-flex flex-lg-row flex-column justify-lg-space-between align-lg-center"
      >
        <div class>
          <v-img
            class="profile-img"
            cover
            height="100"
            width="100"
            :src="img"
          />
        </div>
        <div class="py-3">
          <div class="h-text pb-2">
            Matric No.
          </div>
          <div class="body-text">
            15CJ02876
          </div>
        </div>
        <div class="py-3">
          <div class="h-text pb-2">
            Level
          </div>
          <div class="body-text">
            500
          </div>
        </div>
        <div class="py-3">
          <div class="h-text pb-2">
            Department
          </div>
          <div class="body-text">
            EIE
          </div>
        </div>
        <div class="py-3">
          <div class="h-text pb-2">
            Course
          </div>
          <div class="body-text">
            Computer Engineering
          </div>
        </div>
        <div class="py-3">
          <div class="h-text pb-2">
            Session
          </div>
          <div class="body-text">
            2019/2020
          </div>
        </div>
        <div class="py-3">
          <div class="h-text pb-2">
            Status
          </div>
          <div class="body-text">
            Promoted
          </div>
        </div>
      </div>
    </v-card>
  </div>
</template>

<script>
export default {
	data: () => ({
		img:
			"https://static.wixstatic.com/media/415a35bc6e1642e2a0f53f9a1963eb1d.jpg"
	})
};
</script>

<style lang="scss" scoped>
.profile-img {
	border-radius: 10px;
}
</style>
