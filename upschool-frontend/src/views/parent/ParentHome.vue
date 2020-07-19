<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col cols="12">
          <div
            class="d-flex flex-lg-row flex-column align-start align-lg-end justify-content-between"
          >
            <h2 class="font-weight-light mb-lg-0 mb-3">
              Hi, Covenant University,
              <br />Welcome to Upschool!
            </h2>
            <!-- <v-spacer></v-spacer> -->
            <div class="mb-lg-0 mb-3">{{ new Date(Date.now()).toDateString() }}</div>
          </div>
          <v-divider></v-divider>
        </v-col>
        <v-col cols="12">
          <v-card flat class="pa-3 mt-5 d-flex" height="700px">
            <v-row justify="center" align="center">
              <v-col cols="12" md="6">
                <div class="bg-svg">
                  <!-- <v-img :src="require('@/assets/svg/home_image.svg')" width="75%" contain /> -->
                </div>
              </v-col>
              <v-col cols="12" md="6">
                <div class="d-flex flex-column justify-center justify-lg-start">
                  <div class>
                    <v-chip color="primary" small class="ma-5">UNIVERSITY EDITION</v-chip>
                  </div>
                  <v-card-text class="subtitle-1 pa-5">
                    We're equipped to give you the best school
                    management experience ever ranging from
                    management of courses, fees, students, grades &
                    results
                  </v-card-text>
                </div>
                <v-btn color="success" class="ma-5" @click="$router.push({ name: 'parent.setup' })">
                  <v-icon class="mr-2">mdi-settings</v-icon>Let's get you all set up
                </v-btn>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<style lang="scss" scoped>
.bg-svg {
  min-height: 300px;
  //   background-color: aquamarine;
  background-image: url("./../../assets/svg/home_image.svg");
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center center;
}
</style>