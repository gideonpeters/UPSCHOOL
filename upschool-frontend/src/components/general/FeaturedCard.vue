<template>
  <div>
    <v-card v-if="latestNews" class="pa-3 mb-5" flat>
      <custom-header title="FEATURED POST" ctaText="View" route="student.news"></custom-header>

      <v-img
        :src="latestNews?
										`${uri}${latestNews.image.url}`: ''
									"
        class="white--text align-end"
        gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.8)"
        height="200px"
      >
        <v-card-title class="py-0" v-text="latestNews? latestNews.title: ''"></v-card-title>
        <v-card-title class="fs-4 py-0">
          <div v-html="latestNews ? latestNews.body :''" v-line-clamp:20="4"></div>
        </v-card-title>
        <v-card-actions class="py-0">
          <v-spacer></v-spacer>

          <v-btn text color="white" @click.stop="handlePropClick">READ MORE</v-btn>
        </v-card-actions>
        <template v-slot:placeholder>
          <v-row class="fill-height grey ma-0" align="center" justify="center">
            <div class="headline text-center white--text text-bold"></div>
          </v-row>
        </template>
      </v-img>
    </v-card>
    <v-card v-else flat class="pa-3 mb-5">
      <div>No Featured news available</div>
    </v-card>
  </div>
</template>

<script>
export default {
  props: {
    latestNews: {
      type: Object
    },
    route: {
      type: String
    },
    handleClick: {
      type: Function
    }
  },
  data() {
    return {
      uri: process.env.VUE_APP_BACKEND_IMAGE_URI
    };
  },
  methods: {
    handlePropClick() {
      this.handleClick(this.latestNews.id);
    }
  }
};
</script>