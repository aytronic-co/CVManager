const routes = [
  {
    path: "/login",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/LoginPage.vue"),
        meta: {
          requireAuth: false,
          login: true,
        },
      },
    ],
  },
  {
    path: "/verify",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/ConfirmPage.vue"),
        meta: {
          requireAuth: false,
        },
      },
    ],
  },
  {
    path: "/",
    component: () => import("layouts/SecondLayout.vue"),
    children: [
      { path: "", component: () => import("pages/DashboardPage.vue") },
    ],
    meta: {
      requireAuth: true,
      // dashboard: true,
    },
  },
  {
    path: "/dashboard",
    component: () => import("layouts/SecondLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/DashboardPage.vue"),
        meta: {
          requireAuth: true,
          // dashboard: true,
        },
      },
    ],
  },
  {
    path: "/contact",
    component: () => import("layouts/SecondLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/ContactPage.vue"),
        meta: {
          requireAuth: true,
        },
      },
    ],
  },
  {
    path: "/resume",
    component: () => import("layouts/SecondLayout.vue"),
    children: [{ path: "", component: () => import("pages/ResumePage.vue") }],
    meta: {
      requireAuth: true,
    },
  },
  {
    path: "/profile",
    component: () => import("layouts/SecondLayout.vue"),
    children: [{ path: "", component: () => import("pages/ProfilePage.vue") }],
    meta: {
      requireAuth: true,
    },
  },
  {
    path: "/skils",
    component: () => import("layouts/SecondLayout.vue"),
    children: [{ path: "", component: () => import("pages/SkilsPage.vue") }],
    meta: {
      requireAuth: true,
    },
  },
  {
    path: "/work",
    component: () => import("layouts/SecondLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/WorkPage.vue"),
      },
    ],
    meta: {
      requireAuth: true,
    },
  },
  {
    path: "/portfolio",
    component: () => import("layouts/SecondLayout.vue"),
    children: [
      { path: "", component: () => import("pages/PortfolioPage.vue") },
    ],
    meta: {
      requireAuth: true,
    },
  },
  {
    path: "/educations",
    component: () => import("layouts/SecondLayout.vue"),
    children: [
      { path: "", component: () => import("pages/EducationsPage.vue") },
    ],
    meta: {
      requireAuth: true,
    },
  },
  {
    path: "/biography",
    component: () => import("layouts/SecondLayout.vue"),
    children: [
      { path: "", component: () => import("pages/BiographyPage.vue") },
    ],
    meta: {
      requireAuth: true,
    },
  },
  {
    path: "/about",
    component: () => import("layouts/SecondLayout.vue"),
    children: [{ path: "", component: () => import("pages/AboutPage.vue") }],
    meta: {
      requireAuth: true,
    },
  },
  {
    path: "/settings",
    component: () => import("layouts/SecondLayout.vue"),
    children: [{ path: "", component: () => import("pages/SettingsPage.vue") }],
    meta: {
      requireAuth: true,
    },
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
