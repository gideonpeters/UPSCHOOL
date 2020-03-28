<template>
  <div class="d-flex justify-center">
    <v-dialog
      v-model="dialog"
      width="500"
    >
      <template v-slot:activator="{ on }">
        <div
          class="d-flex flex-column text-center attendance-item justify-space-between pt-5 pb-4 ma-2"
        >
          <div>
            <div>{{ title + " DEFAULTS" }}</div>
            <div>{{ number }}</div>
          </div>
          <div>
            <div
              class="pointer action py-2"
              v-on="on"
            >
              View Defaults
            </div>
          </div>
        </div>
      </template>

      <v-card>
        <v-card-title
          class="headline"
          primary-title
        >
          {{
            title + " DEFAULTS"
          }}
        </v-card-title>

        <v-card-text>
          <v-layout>
            <v-flex>
              <ul
                v-for="i in number"
                :key="i"
              >
                <li
                  v-if="i % 2 != 0"
                  class="py-2"
                >
                  <span>{{ "Sunday, 15th November" }}</span>
                </li>
              </ul>
            </v-flex>
            <v-flex>
              <ul
                v-for="i in number"
                :key="i"
              >
                <li
                  v-if="i % 2 == 0"
                  class="py-2"
                >
                  <span>{{ "Tuesday, 18th November" }}</span>
                </li>
              </ul>
            </v-flex>
          </v-layout>

          <!-- <div>ddk</div> -->
        </v-card-text>

        <v-divider />

        <v-card-actions>
          <v-spacer />
          <v-btn
            color="primary"
            text
            @click="dialog = false"
          >
            CLOSE
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
	props: {
		title: {
			type: String
		},
		number: {
			type: Number
		}
	},
	data() {
		return {
			dialog: false
		};
	}
};
</script>

<style lang="scss" scoped>
.attendance-item {
	color: white;
	background-color: #683587;
	border-radius: 10px;
	width: 280px;
	min-height: 150px;

	.action {
		display: inline-block;
		font-size: 0.6rem;
		background-color: white;
		color: #683587;
		border-radius: 3px;
		padding: 0 30px 0 30px;
	}
}
</style>
