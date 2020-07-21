<template>
  <v-card flat>
    <v-img v-if="previewImage" :src="previewImage" height="100" width="100" cover class="my-2"></v-img>
    <div class="mt-5">
      <v-file-input
        :rules="rules"
        prepend-inner-icon="mdi-paperclip"
        prepend-icon
        @change="showImage"
        show-size
        outlined
        accept="image/*"
        label="Select Cover Image"
      ></v-file-input>
    </div>
    <div>
      <v-text-field @trix-file-accept="false" v-model="postTitle" label="Title" outlined></v-text-field>
    </div>
    <div>
      <vue-editor :editorToolbar="customToolbar" v-model="editorContent2"></vue-editor>
      <!-- <trix-vue v-model="editorContent"></trix-vue> -->
    </div>
    <div class="d-flex justify-space-between mt-5 align-center">
      <v-checkbox label="Make Featured Post ?" v-model="isFeatured"></v-checkbox>
      <v-btn
        color="success"
        @click="createNews"
        :disabled="!(this.postTitle && this.editorContent2)"
      >Submit</v-btn>
    </div>
  </v-card>
</template>

<script>
import { VueEditor } from "vue2-editor";
import Axios from "axios";

export default {
  // ...
  components: {
    VueEditor
  },
  data() {
    return {
      postTitle: "",
      editorContent2: "",
      isFeatured: false,
      image: "",
      previewImage: "",
      too: [],
      customToolbar: [
        ["bold", "italic", "underline", "strike"],
        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
        [{ align: "" }, { align: "justify" }, { align: "right" }],
        [{ indent: "-1" }, { indent: "+1" }],
        [{ script: "sub" }, { script: "super" }],
        [{ size: ["small", false, "large", "huge"] }],
        ["code-block", "link"]
      ],
      rules: [
        value =>
          !value ||
          value.size < 2000000 ||
          "Cover image size should be less than 2 MB!"
      ]
    };
  },
  methods: {
    doNothing() {},
    showImage(ent) {
      var reader = new FileReader();
      // console.log(ent);
      this.image = ent;

      reader.readAsDataURL(ent);

      reader.onload = async evt => {
        this.previewImage = evt.target.result;
      };
    },
    async createNews() {
      try {
        const body = new FormData();
        body.append("image", this.image);
        body.append("body", this.editorContent2);
        body.append("title", this.postTitle);
        body.append("featured", this.isFeatured);

        let res = await Axios.post("news", body, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        });

        this.$store.commit("openSnackbar", res.data.message);
        this.$store.dispatch("getNews");

        this.$emit("save-item");
      } catch (error) {
        throw error;
      }
    }
  }
};
</script>
