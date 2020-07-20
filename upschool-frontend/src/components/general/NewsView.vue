<template>
  <div>
    <v-container fluid class="pa-0">
      <v-row>
        <v-col cols="12" md="8">
          <div class="d-flex flex-column">
            <featured-card
              :latestNews="latestNews"
              :route="'staff.news.details'"
              :handleClick="goToNews"
            />

            <div class="d-flex justify-space-between align-center">
              <v-subheader
                class="pa-0 text-uppercase"
              >{{news.length > 0 ? 'NEWS & ANNOUNCEMENTS' : 'No news posted yet'}}</v-subheader>
              <div v-if="isAdmin">
                <v-dialog
                  v-model="dialogFull"
                  fullscreen
                  hide-overlay
                  transition="dialog-bottom-transition"
                >
                  <template v-slot:activator="{ on }">
                    <v-btn color="blue accent-4" text v-on="on">POST NEWS</v-btn>
                  </template>
                  <v-card>
                    <v-toolbar dark color="primary">
                      <v-btn icon dark @click="dialogFull = false">
                        <v-icon>mdi-close</v-icon>
                      </v-btn>
                      <v-toolbar-title>Create News Post</v-toolbar-title>
                      <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-container>
                      <v-row justify="center">
                        <v-col cols="12">
                          <editor @save-item="dialogFull = false" />
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-card>
                </v-dialog>
              </div>
            </div>
            <div>
              <v-card flat class="pa-3 mb-4" v-for="newsItem in news" :key="newsItem.id">
                <news-item
                  :newsItem="newsItem"
                  :isStudent="isStudent"
                  :isStaff="isStaff"
                  :isAdmin="isAdmin"
                />
              </v-card>
            </div>
          </div>
        </v-col>

        <v-col>
          <div class="d-flex justify-space-between align-center">
            <v-subheader class="pa-0">SCHOOL EVENTS</v-subheader>
            <v-btn color="blue accent-4" text v-if="isAdmin">CREATE EVENT</v-btn>
          </div>

          <v-card class="pa-3 mb-4" flat v-for="event in events" :key="event.id">
            <event-item :event="event" />
          </v-card>
          <v-card class="pa-3 mb-4" flat v-if="events.length == 0">
            <div>No school events created yet</div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import NewsItem from "./NewsItem";
import Editor from "./Editor";
import EventItem from "./EventItem";
import FeaturedCard from "./FeaturedCard";

export default {
  name: "news-view",
  props: {
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
  components: {
    NewsItem,
    Editor,
    EventItem,
    FeaturedCard
  },
  data() {
    return {
      dialogFull: false,
      uri: process.env.VUE_APP_BACKEND_IMAGE_URI
    };
  },
  computed: {
    news() {
      return this.$store.state.news;
    },
    latestNews() {
      return this.$store.state.news[0];
    },
    events() {
      return this.$store.state.schoolEvents;
    }
  },
  methods: {
    goToPage(name) {
      this.$router.push({ name: name });
    },
    goToNews(id) {
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
    }
  },
  async mounted() {
    try {
      this.$store.dispatch("getNews");
      this.$store.dispatch("getSchoolEvents");
    } catch (error) {
      throw error;
    }
  }
};
</script>
