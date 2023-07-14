const admin = [
  {
    path: "/admin",
    component: () => import("../layouts/admin.vue"),
    children: [
      // Quan ly users
      {
        path: "users",
        name: "admin-users",
        component: () => import("../pages/admin/users/index.vue"),
      },
      // Tao moi user
      {
        path: "users/create",
        name: "admin-users-create",
        component: () => import("../pages/admin/users/create.vue"),
      },
      // Tao moi user
      {
        path: "users/edit/:id",
        name: "admin-users-edit",
        component: () => import("../pages/admin/users/edit.vue"),
      },
      // Quan ly roles
      {
        path: "roles",
        name: "admin-roles",
        component: () => import("../pages/admin/roles/index.vue"),
      },
      // Quan ly setting
      {
        path: "settings",
        name: "admin-settings",
        component: () => import("../pages/admin/settings/index.vue"),
      },
    ],
  },
];

export default admin;
