<template>
  <div>
    <div>
      <v-btn color="grey" icon @click="$router.go(-1)">
        <v-icon>mdi-arrow-left</v-icon>
      </v-btn>
    </div>
    <div class="pa-3">
      <v-img v-if="news.image.url" :src="`${uri}${news.image.url}`" height="300" contain>
        <template v-slot:placeholder>
          <v-row class="fill-height grey ma-0" align="center" justify="center">
            <div class="headline text-center white--text text-bold"></div>
          </v-row>
        </template>
      </v-img>
      <h2 class="mt-2">{{ news.title }}</h2>
      <div class="fs-5 mb-3 mt-2">Uploaded {{moment(news.created_at).fromNow()}}</div>
      <v-divider></v-divider>
      <div v-html="news.body" class="mt-3"></div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    isStudent: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      uri: process.env.VUE_APP_BACKEND_IMAGE_URI
    };
  },
  computed: {
    news() {
      let id = this.$route.params.id;

      return this.$store.getters.getNewsById(id);
    }
  }
};
</script>
