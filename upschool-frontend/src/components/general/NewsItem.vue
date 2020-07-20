<template>
  <v-row align="start">
    <v-col cols="4" md="3">
      <div>
        <v-img :src="`${uri}${newsItem.image.url}`" height="150">
          <template v-slot:placeholder>
            <v-row class="fill-height grey ma-0" align="center" justify="center">
              <div class="headline text-center white--text text-bold"></div>
            </v-row>
          </template>
        </v-img>
      </div>
    </v-col>
    <v-col cols="8" md="9">
      <v-card flat class="d-flex flex-column" height="150">
        <v-row no-gutters>
          <v-col cols="11">
            <div class="fs-3 font-weight-bold">{{ newsItem.title }}</div>
            <v-card
              flat
              max-height="76"
              class="fs-4 mt-2"
              v-line-clamp:20="4"
              v-html="newsItem.body"
            ></v-card>
          </v-col>
          <v-col cols="1">
            <div class="d-flex justify-end" v-if="!isStudent">
              <v-menu offset-y>
                <template v-slot:activator="{ on }">
                  <v-btn v-on="on" depressed color="white" icon :ripple="false">
                    <v-icon color="grey">mdi-dots-vertical</v-icon>
                  </v-btn>
                </template>
                <v-list>
                  <v-list-item
                    v-for="(item, index) in newsActions"
                    :key="index"
                    @click="fn(newsItem.id)"
                  >
                    <v-list-item-title>
                      {{
                      item.title
                      }}
                    </v-list-item-title>
                  </v-list-item>
                </v-list>
              </v-menu>
            </div>
          </v-col>
          <v-col cols="12" class="mt-auto">
            <div class="d-flex mt-auto">
              <v-spacer></v-spacer>
              <v-btn
                color="primary"
                text
                @click="
									goToPage(newsItem.id)
								"
              >Read more</v-btn>
            </div>
          </v-col>
        </v-row>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import Axios from "axios";
export default {
  props: {
    newsItem: {
      type: Object
    },
    isStudent: {
      type: Boolean,
      default: false
    },
    isStaff: {
      type: Boolean,
      default: false
    },
    isAdmin: {
      type: Boolean,
      default: false
    }
  },
  data: () => ({
    newsActions: [
      { id: 1, title: "Edit", fn: () => {} },
      { id: 2, title: "Delete", fn: id => this.deleteItem(id) }
    ],
    uri: process.env.VUE_APP_BACKEND_IMAGE_URI

    // 	img:
    // 		"https://static.wixstatic.com/media/415a35bc6e1642e2a0f53f9a1963eb1d.jpg"
  }),
  methods: {
    goToPage(id) {
      if (this.isStudent) {
        return this.$router.push({
          name: "student.news.details",
          params: { id: id }
        });
      } else if (this.isStaff) {
        return this.$router.push({
          name: "staff.news.details",
          params: { id: id }
        });
      } else if (this.isAdmin) {
        return this.$router.push({
          name: "parent.news.details",
          params: { id: id }
        });
      }
      // this.$router.push({
      // 	name: "parent.news.details",
      // 	params: { id: id }
      // });
    },
    async deleteItem(id) {
      try {
        let res = await Axios.delete("news", id);

        this.$store.commit("openSnackbar", res.data.message);
        if (res.data.status) {
          this.$store.dispatch("getNews");
        }
      } catch (error) {
        throw error;
        // console.log(error);
      }
    }
  }
};
</script>
