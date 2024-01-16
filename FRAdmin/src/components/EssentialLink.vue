<template>
<<<<<<<< HEAD:FE/src/components/EssentialLink.vue
  <q-item
    clickable
    tag="a"
    :href="link"
  >
    <q-item-section
      v-if="icon"
      avatar
    >
========
  <q-item clickable tag="a" :href="link">
    <q-item-section v-if="icon" avatar>
>>>>>>>> 6cc72777352c1fbc895c0b4373a675d2a49e80c1:FRAdmin/src/components/EssentialLink.vue
      <q-icon :name="icon" />
    </q-item-section>

    <q-item-section>
      <q-item-label>{{ title }}</q-item-label>
      <q-item-label caption>{{ caption }}</q-item-label>
    </q-item-section>
  </q-item>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "EssentialLink",
  props: {
    title: {
      type: String,
      required: true,
    },

    caption: {
      type: String,
      default: "",
    },

    link: {
      type: String,
      default: "#",
    },

    icon: {
      type: String,
      default: "",
    },
  },
});
</script>
