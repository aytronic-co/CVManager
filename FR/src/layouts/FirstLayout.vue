<template>
  <q-layout view="hHh lpR fFf" dir="rtl">
    <q-header elevated class="text-white z-top" height="150px">
      <q-toolbar>
        <q-btn flat dense round icon="menu" aria-label="Menu" />
        <q-toolbar-title>
          <q-tabs>
            <q-tab @click="goTo('homeTag')" label="خانه" />
            <q-tab @click="goTo('aboutTag')" label="درباره ما" />
            <q-tab @click="goTo('portfolioTag')" label="نمونه کارها" />
            <q-tab @click="goTo('contactTag')" label="تماس با ما" />
            <q-tab @click="goTo('resumeTag')" label="دانلود رزومه" />
          </q-tabs>
        </q-toolbar-title>
        <div>CVManager 2023</div>
      </q-toolbar>
    </q-header>
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { ref } from "vue";

export default {
  // name: 'LayoutName',

  setup() {
    const leftDrawerOpen = ref(false);
    function goTo(param) {
      document.getElementById(param).scrollIntoView();
    }
    return {
      leftDrawerOpen,
      goTo,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },
};
</script>
