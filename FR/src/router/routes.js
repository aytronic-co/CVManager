
const routes = [
  {
    path: '/',
    component: () => import('layouts/FirstLayout.vue'),
    children: [
      { path: '', component: () => import('pages/IndexPage.vue') }
    ]
  },
  {
    path: '/admin',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/LoginPage.vue') }
    ]
  },
   {
    path: '/confirm',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/ConfirmPage.vue') }
    ]
  },
   {
    path: '/dashboard',
    component: () => import('layouts/SecondLayout.vue'),
    children: [
      { path: '', component: () => import('pages/DashboardPage.vue') }
    ]
  },
     {
    path: '/contact',
    component: () => import('layouts/SecondLayout.vue'),
    children: [
      { path: '', component: () => import('pages/ContactPage.vue') }
    ]
  },
    {
    path: '/resume',
    component: () => import('layouts/SecondLayout.vue'),
    children: [
      { path: '', component: () => import('pages/ResumePage.vue') }
    ]
  },
    {
    path: '/about',
    component: () => import('layouts/SecondLayout.vue'),
    children: [
      { path: '', component: () => import('pages/َAboutPage.vue') }
    ]
  },
      {
    path: '/skils',
    component: () => import('layouts/SecondLayout.vue'),
    children: [
      { path: '', component: () => import('pages/َSkilsPage.vue') }
    ]
  },
    {
    path: '/portfolio',
    component: () => import('layouts/SecondLayout.vue'),
    children: [
      { path: '', component: () => import('pages/َPortfolioPage.vue') }
    ]
  },
    {
    path: '/biography',
    component: () => import('layouts/SecondLayout.vue'),
    children: [
      { path: '', component: () => import('pages/َBiographyPage.vue') }
    ]
  },
    {
    path: '/settings',
    component: () => import('layouts/SecondLayout.vue'),
    children: [
      { path: '', component: () => import('pages/َSettingsPage.vue') }
    ]
  },  {
    path: '/educations',
    component: () => import('layouts/SecondLayout.vue'),
    children: [
      { path: '', component: () => import('pages/َEducationsPage.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
