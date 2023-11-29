<template>
  <q-layout view="lHh Lpr lFf " dir=rtl >
    <q-header elevated >
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>
       داشبورد مدیریت
        </q-toolbar-title>

        <div>CVManager 2023</div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
    >
      <q-list >
        <q-item-label
          header
        >
          افزودن اطلاعات
        </q-item-label>

        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import EssentialLink from 'components/EssentialLink.vue'

const linksList = [
  {
    title: 'پروفایل',
    icon: 'school',
    link: 'http://localhost:9200/#/profile'
  },

    {
    title: 'مهارت ها',
    icon: 'school',
    link: 'http://localhost:9200/#/skils'
  },


  {
    title: 'نمونه کارها',
    icon: 'school',
    link: 'http://localhost:9200/#/portfolio'
  },
  {
    title: 'تحصیلات',
    icon: 'school',
    link: 'http://localhost:9200/#/educations'
  },
   {
    title: 'اطلاعات تماس',
    icon: 'school',
    link: 'http://localhost:9200/#/contact'
  },
  {
    title: 'رزومه',
    icon: 'school',
    link: 'http://localhost:9200/#/resume'
  },
  {
    title: 'بیوگرافی',
    icon: 'school',
    link: 'http://localhost:9200/#/biography'
  },

     {
    title: ' درباره ما',
    icon: 'school',
    link: 'http://localhost:9200/#/about'
  },
   {
    title: 'تنظیمات',
    icon: 'school',
    link: 'http://localhost:9200/#/settings'
  },
    {
    title: ' خروج از داشبورد ',
    icon: 'school',
    link: 'http://localhost:9200/#/'
  },


 ]

export default defineComponent({
  // name: 'MainLayout',

  components: {
    EssentialLink
  },

  setup () {
    const leftDrawerOpen = ref(false)

    return {
      essentialLinks: linksList,
      leftDrawerOpen,
      toggleLeftDrawer () {
      leftDrawerOpen.value = !leftDrawerOpen.value
      }
    }
  }
})
</script>
