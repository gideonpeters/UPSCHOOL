<template>
	<v-card flat>
		<div class="mt-5">
			<v-file-input :rules="rules" show-size outlined accept="image/*" label="Select Cover Image"></v-file-input>
		</div>
		<div>
			<v-text-field @trix-file-accept="false" v-model="postTitle" label="Title" outlined></v-text-field>
		</div>
		<div>
			<vue-editor :editorToolbar="customToolbar" v-model="editorContent2"></vue-editor>
			<!-- <trix-vue v-model="editorContent"></trix-vue> -->
		</div>
	</v-card>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
	// ...
	components: {
		VueEditor
	},
	data() {
		return {
			editorContent: "",
			postTitle: "",
			editorContent2: "",
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
		doNothing() {}
	}
};
</script>
